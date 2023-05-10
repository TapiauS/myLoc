<?php

class ItemCategoryManager extends Manager{
    
    public static function getCategory(int $id):ItemCategory{
        try{
            $query='SELECT category_name,associated_points FROM category_item WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($row=$pst->fetch())
                return new ItemCategory($id,$row['category_name'],$row['associated_points']);
        }
        catch(PDOException $pdoe){
            //todo gérer
        }
        catch(Exception $e){
            
        }
    }

    public static function getAllCategories():array{
        try{
            $query='SELECT * FROM category_item';
            $pst=self::startquery($query);
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                array_push($retour,new ItemCategory($row['id'],$row['category_name'],$row['associated_points']));
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            //todo tkt
        }
    }

    public static function deleteCategorie(int $id):bool{
        try{
            $query="DELETE FROM category_item WHERE id=:id";
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505)
                return false;
        }
    }

    public static function createCategory(string $name,int $associatedPoints):ItemCategory|false{
        try{
            $query="INSERT INTO category_item(category_name,associated_points) VALUES (:name,:associatedpoints) RETURNING id";
            $pst=self::startquery($query);
            $pst->bindValue('name',$name);
            $pst->bindValue('associatedpoints',$associatedPoints);
            $pst->execute();
            if($row=$pst->fetch())
                return new ItemCategory($row['id'],$name,$associatedPoints);
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
        }
    }

    public static function updateCategory(string $name,int $associatedPoints):ItemCategory|false{
        try{
            $query="UPDATE TABLE category_item SET category_name=:name,associated_points=:associatedpoints RETURNING id";
            $pst=self::startquery($query);
            $pst->bindValue('name',$name);
            $pst->bindValue('associatedpoints',$associatedPoints);
            $pst->execute();
            if($row=$pst->fetch())
                return new ItemCategory($row['id'],$name,$associatedPoints);
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505||$pdoe->getCode()===23514)
                return false;
        }
    }
}
