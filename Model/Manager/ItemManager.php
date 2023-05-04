<?php

class ItemManager extends Manager{

    public static function getAllitems():array{
        try{
            $query='SELECT * FROM item';
            $pst=self::startquery($query);
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $item=new Item($row['id'],UserManager::getUser($row['id_user']),$row['description'],ItemCategoryManage::getCategory($row['id_category_item']),$row['pictureName']);
                array_push($retour,$item);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            //TODO gérer
        }
    }

}
