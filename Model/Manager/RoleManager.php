<?php

class RoleManager extends Manager{

    public static function getRole(int $id):Role{
        try{
            $query='SELECT role_name FROM _role WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($row=$pst->fetch())
                return Role::fromName($row['role_name']);
        }
        catch(PDOException $pdoe){
            //todo gérer
        }
    }

}