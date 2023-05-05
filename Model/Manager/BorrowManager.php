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
                $borrow=new Borrow($row['id'],$borrower,DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),ItemManager::getItem($row['id_item']));
                array_push($retour,$borrow);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            //todo gérer
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
                $borrow=new Borrow($row['id'],UserManager::getUser($row['id_user']),DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),ItemManager::getItem($row['id_item']));
                array_push($retour,$borrow);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            //todo tkt
        }
    }

    public static function getAllBorrow(Item $borroweditem){
        try{
            $query="SELCT * FROM borrow WHERE id_item=:id";
            $pst=self::startquery($query);
            $pst->bindValue('id',$borroweditem->getId());
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $borrow=new Borrow($row['id'],UserManager::getUser($row['id_user']),DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),$borrowedItem);
                array_push($retour,$borrow);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            //todo tkt
        }
    }

    public static function addBorrow(Item $borrowedItem,User $borrower,DateTime $startDate,DateTime $endDate):Borrow|false{
        try{
            $query='INSERT INTO borrow(id_item,id_user,startdate,enddate) VALUES (:idItem,:idUser,:start,:end) RETURNING id';
            $pst=self::startquery($query);
            $pst->bindValue('idItem',$borrowedItem->getId());
            $pst->bindValue('idUser',$borrower->getId());
            $pst->bindValue('start',$startDate,PDO::PARAM_STR);
            $pst->bindValue('end',$endDate,PDO::PARAM_STR);
            $pst->execute();
            if($row=$pst->fetch())
                return new Borrow($row['id'],$borrower,$startDate,$endDate,$borrowedItem);
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
        }
    }


    public static function updateBorrow(DateTime $endDate):bool{
        try{
            $query="UPDATE borrow SET enddate=:enddate RETURNING id";
            $pst=self::startquery($query);
            $pst->bindValue('enddate',$endDate,PDO::PARAM_STR);
            $pst->execute();
            return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
        }
    }
}