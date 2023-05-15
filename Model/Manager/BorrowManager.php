<?php 

class BorrowManager extends Manager{

    public static function getBorrowedItem(User $borrower):array{
        try{
            $query='SELECT * FROM borrow WHERE id_user=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$borrower->getId());
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $borrow=new Borrow($row['id'],$borrower,DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),ItemManager::getItem($row['id_item']),$row['accepted']);
                array_push($retour,$borrow);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function getLandedItem(User $lander):array{
        try{
            $query='SELECT * FROM borrow JOIN item ON id_item=item.id JOIN _user ON user.id=item.id_user AND user.id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$lander->getId());
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $borrow=new Borrow($row['id'],UserManager::getUser($row['id_user']),DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),ItemManager::getItem($row['id_item']),$row['accepted']);
                array_push($retour,$borrow);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function getAllBorrow(Item $borroweditem){
        try{
            $query="SELECT * FROM borrow WHERE id_item=:id";
            $pst=self::startquery($query);
            $pst->bindValue('id',$borroweditem->getId());
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $borrow=new Borrow($row['id'],UserManager::getUser($row['id_user']),DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),$borroweditem);
                array_push($retour,$borrow);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function addBorrow(Item $borrowedItem,User $borrower,DateTime $startDate,DateTime $endDate):Borrow|false{
        try{
            $query='INSERT INTO borrow(id_item,id_user,startdate,enddate) VALUES (:idItem,:idUser,:start,:end) RETURNING id';
            $pst=self::startquery($query);
            $pst->bindValue('idItem',$borrowedItem->getId());
            $pst->bindValue('idUser',$borrower->getId());
            $pst->bindValue('start',$startDate->format('Y-m-d'));
            $pst->bindValue('end',$endDate->format('Y-m-d'));
            $pst->execute();
            if($row=$pst->fetch())
                return new Borrow($row['id'],$borrower,$startDate,$endDate,$borrowedItem);
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }


    public static function updateBorrow(Borrow $updatedborrow):bool{
        try{
            $query="UPDATE borrow SET enddate=:enddate,accepted=:accepted WHERE id=:id RETURNING id";
            $pst=self::startquery($query);
            $pst->bindValue('enddate',$updatedborrow->getEnd(),PDO::PARAM_STR);
            $pst->bindValue('accepted',$updatedborrow->getAccepted());
            $pst->bindValue('id',$updatedborrow->getId());
            $pst->execute();
            return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function validateBorrow(int $id,int $iditem){
        try{
            $query="UPDATE borrow SET accepted=true WHERE id=:id AND AND id_item=(SELECT id FROM item WHERE id=:idtem AND id_user=:iduser) RETURNING id";
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->bindValue('iditem',$iditem);
            $pst->bindValue('iduser',$_SESSION['user']->getId());
            $pst->execute();
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function refuseBorrow(int $id,int $iditem):bool{
        try{
            $query='DELETE FROM borrow WHERE id=:id AND id_item=(SELECT id FROM item WHERE id=:idtem AND id_user=:iduser)';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->bindValue('iditem',$iditem);
            $pst->bindValue('iduser',$_SESSION['user']->getId());
            $pst->execute();
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function deleteBorrow(int $id):bool{
        try{
            $query='DELETE FROM borrow WHERE id=:id AND id_user=:iduser';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->bindValue('iduser',$_SESSION['user']->getId());
            $pst->execute();
            return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function getBorrow(int $id):Borrow|false{
        try{
            $query='SELECT * FROM borrow WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($row=$pst->fetch())
                return new Borrow($id,UserManager::getUser($row['id_user']),DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),ItemManager::getItem($row['id_item']));
            }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }
}