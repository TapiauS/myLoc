<?php

enum ItemCategory {
    case LARGE;
    case MEDIUM;
    case SMALL;
    case PRECIOUS;

    
    public static function fromName(string $name): ItemCategory
    {
        foreach (self::cases() as $categorie) {
            if( $name === $categorie->name ){
                return $categorie;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum " . self::class );
    }
}