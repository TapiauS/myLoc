<?php

class ItemManager extends Manager{

    public static function getAllitems():array{
        try{
            $query='SELECT * FROM item';
            $pst=self::startquery($query);
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $item=new Item($row['id'],UserManager::getUser($row['id_user']),$row['description'],ItemCategoryManager::getCategory($row['id_category_item']),$row['pictureName']);
                array_push($retour,$item);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            //TODO gérer
        }
    }

    public static function getItem(int $id):Item{
        try{
            $query='SELECT * FROM item WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($row=$pst->fetch())
                return new Item($id);
        }
        catch(PDOException $pdoe){
            //todo gérer
        }
    }

    public static function deleteItem(int $id):bool{
        try{
            $query='DELETE FROM item WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            $borrows=BorrowManager::getAllBorrow(ItemManager::getItem($id));

                return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
        }
    }

    public static function createItem(string $name,?string $description,string $categorie,int $idUser,?string $picturePath):Item|false{
        try{
            $query='INSERT INTO item(name,description,picturepath,id_user,id_category_item) VALUES (:name,:description,:picturepath,:id_user,(SELECT id FROM category_item WHERE category_name=:categorie)) RETURNING id';
            $pst=self::startquery($query);
            $pst->bindValue('name',$name);
            $pst->bindValue('description',$description);
            $pst->bindValue('picturepath',$picturePath);
            $pst->bindValue('id_user',$idUser);
            $pst->bindValue('categorie',$categorie);
            if($row=$pst->fetch())
                return self::getItem($row['id']);
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
        }
    }

    public static function updateItem(string $name,?string $description,int $idCategorie,?string $picturePath):Item|false{
        try{
            $query='UPDATE item SET name=:name,description=:description,picture_path=:picturepath,id_category_item=;idcat RETURNING id';
            $pst=self::startquery($query);
            $pst->bindValue('name',$name);
            $pst->bindValue('description',$description);
            $pst->bindValue('picturepath',$picturePath);
            $pst->bindValue('idcat',$idCategorie);
            if($row=$pst->fetch())
                return self::getItem($row['id']);
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23503)
                return false;
        }
    }

}
