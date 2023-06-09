<?php

class ItemManager extends Manager{

    public static function getAllitems():array|false{
        try{
            $query='SELECT * FROM item';
            $pst=self::startquery($query);
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $item=new Item($row['id'],UserManager::getUser($row['id_user']),$row['description'],ItemCategoryManager::getCategory($row['id_category_item']),$row['picture_path'],$row['name']);
                array_push($retour,$item);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe);
        }
    }


    public static function getItem(int $id):Item{
        try{
            $query='SELECT * FROM item WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($row=$pst->fetch())
                return new Item($id,UserManager::getUser($row['id_user']),$row['description'],ItemCategoryManager::getCategory($row['id_category_item']),$row['picture_path'],$row['name']);
        }
        catch(PDOException $pdoe){
            throw new MylocManagerException($pdoe->getMessage(),$pdoe);
        }
    }

    public static function deleteItem(int $id):bool{
        try{
            $query='DELETE FROM item WHERE id=:id AND id_user=:iduser';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->bindValue('iduser',$_SESSION['user']->getId());
            $pst->execute();
            return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe);
        }
    }

    public static function createItem(string $name,?string $description,string $categorie,int $idUser,?string $picturePath):Item|false{
        try{
            $query='INSERT INTO item(name,description,picture_path,id_user,id_category_item) VALUES (:name,:description,:picturepath,:id_user,(SELECT id FROM category_item WHERE category_name=:categorie)) RETURNING id';
            $pst=self::startquery($query);
            $pst->bindValue('name',$name);
            $pst->bindValue('description',$description);
            $pst->bindValue('picturepath',$picturePath);
            $pst->bindValue('id_user',$idUser);
            $pst->bindValue('categorie',$categorie);
            $pst->execute();
            if($row=$pst->fetch())
                return self::getItem($row['id']);
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

    public static function updateItem(string $name,?string $description,int $idCategorie,int $iduser,?string $picturePath,int $id):Item|false{
        try{
            $query='UPDATE item SET name=:name,description=:description,picture_path=:picturepath,id_category_item=:idcat WHERE id=:id AND id_user=:iduser RETURNING id';
            $pst=self::startquery($query);
            $pst->bindValue('name',$name);
            $pst->bindValue('iduser',$iduser);
            $pst->bindValue('id',$id);
            $pst->bindValue('description',$description);
            $pst->bindValue('picturepath',$picturePath);
            $pst->bindValue('idcat',$idCategorie);
            $pst->execute();
            if($row=$pst->fetch())
                return self::getItem($row['id']);
            else
                return false;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

}
