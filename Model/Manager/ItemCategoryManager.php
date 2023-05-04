<?php

class ItemCategoryManager extends Manager{
    
    public static function getCategory(int $id):ItemCategory{
        try{
            $query='SELECT category_name FROM item_category WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($row=$pst->fetch())
                return ItemCategory::fromName($row['category_name']);
        }
        catch(PDOException $pdoe){
            //todo gérer
        }
    }
}
