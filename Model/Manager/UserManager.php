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

    public static function deleteUser(int $id):bool{
        try{
            $query='DELETE FROM _user WHERE id=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$id);
            $pst->execute();
            return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()==='useditem')
                return false;

        }
    }


    public static function createUser(string $pseudo,string $password,string $adress,string $town):User|false{
        try{
            $query="INSERT INTO _user(pseudo,password,id_role,adress,town,points) VALUES (:pseudo,:password,(SELECT id FROM _role WHERE role_name='peon'),:adress,:town,0) RETURNING id";
            $pst=self::startquery($query);
            $pst->bindValue('pseudo',$pseudo);
            $pst->bindValue('password',password_hash($password,PASSWORD_BCRYPT));
            $pst->bindValue('adress',$adress);
            $pst->bindValue('town',$town);
            $pst->execute();
            if($row=$pst->fetch())
                return new User($row['id'],$pseudo,$password,Role::PEON,$town,$adress,0);
            else
                return false;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505)
                return false;
            else
                error_log($pdoe);
                throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
            
        }
    }

    public static function disconnectuser(int $id):bool{
        try{
            $query="UPDATE _user SET connected=false WHERE id=:id";
            $pstco=self::startquery($query);
            $pstco->bindValue('id',$id);
            $pstco->execute();
            return true;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505)
            return false;
        else
            error_log($pdoe);
            throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        
        }
    }

    public static function connectUser(string $pseudo,string $password):User|false{
        try{
            $query="SELECT * FROM _user WHERE pseudo=:pseudo AND connected=false";
            $pst=self::startquery($query);
            $pst->bindValue(1,$pseudo,PDO::PARAM_STR);
            $pst->execute();
            if($row=$pst->fetch())
            {
                if(password_verify($password,$row["password"])):
                    $user=self::getUser($row['id']);
                    $query="UPDATE _user SET connected=true WHERE id=:id";
                    $pstco=self::startquery($query);
                    $pstco->bindValue('id',$row['id']);
                    $pstco->execute();
                    return $user;
                else:
                    return false;   
                endif;    
            } 
            else
                return false;
        }
        catch(PDOException $pdoe){
            //todo gérer
        }
    }

    public static function getUserPoints(int $iduser):int|false{
        try{
            $query='SELECT points FROM _user WHERE id=:iduser';
            $pst=self::startquery($query);
            $pst->bindValue('iduser',$iduser);
            $pst->execute();
            if($row=$pst->fetch())
                return intval($row['points']);
            else 
                return false;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505)
                return false;
            else throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }

    }


    public static function updateUser(int $id,string $pseudo,string $adress,string $town):bool{
        try{
            $query="UPDATE _user SET pseudo=:pseudo,adress=:adress,town=:town WHERE id=:id RETURNING id";
            $pst=self::startquery($query);
            $pst->bindValue('pseudo',$pseudo);
            $pst->bindValue('adress',$adress);
            $pst->bindValue('town',$town);
            $pst->bindValue('id',$id);
            $pst->execute();
            if($pst->fetch())
                return true;
            else 
                return false;
        }
        catch(PDOException $pdoe){
            if($pdoe->getCode()===23505)
                return false;
            else throw new MylocManagerException($pdoe->getMessage(),$pdoe,1,1);
        }
    }

}