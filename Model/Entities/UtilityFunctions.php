<?php

function sanitize(?String $text):String{
    if(!is_null($text))
        return(htmlspecialchars(trim($text)));
    else
        return "";
}

function isavailable(Item $item,DateTime $moment):bool{
    $borrows=BorrowManager::getAllBorrow($item);
    foreach($borrows as $borrow){
        if($moment<$borrow->getEnd()):
            return false;
        endif;
    }
    return true ;
}

