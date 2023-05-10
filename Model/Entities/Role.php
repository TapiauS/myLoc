<?php 
enum Role {
    case PEON;
    case ADMIN;

    public static function fromName(string $name): Role
    {
        foreach (self::cases() as $role) {
            if( strtoupper($name) === $role->name ){
                return $role;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum " . self::class );
    }

}