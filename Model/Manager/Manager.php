<?php

class Manager{
    protected static ?PDO $connect=null;

    protected static function startquery(String $query):PDOStatement{
        if(is_null(self::$connect))
            self::$connect=Connect::getInstance()->getConnexion();
        return self::$connect->prepare($query);
    }
}