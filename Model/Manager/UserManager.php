<?php

class UserManager extends Manager{


    public static function getUser(int $id):?User{
        try{
            $query='SELECT * FROM _user WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($row=$pst->fetch())
                return new User($row['id'],$row['pseudo'],$row['password'],RoleManager::getRole($row['id_role']),$row['town'],$row['adress'],$row['points']);
            else
                return null;
        }
        catch(PDOException $pdoe){
            //TODO GERER
        }
    }

}