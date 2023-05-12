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
            if($pdoe->getCode()===23503)
                return false;
            else
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }
}

