<?php

function sanitize(?String $text):String{
    if(!is_null($text))
        return(htmlspecialchars(trim($text)));
    else
        return "";
}

function isavailable(Item $item,DateTime $start,DateTime $end):bool{
    if($start->format('d')<(new DateTime())->format('d')){
        return false;
    }
    $borrows=BorrowManager::getAllBorrow($item);
    foreach($borrows as $borrow){
        if($borrow->getStart()<=$start && $start<=$borrow->getEnd() || $borrow->getStart()<=$end && $end<=$borrow->getEnd()||$borrow->getStart()>=$start&&$borrow->getEnd()<=$end):
            return false;
        endif;
    }
    return true ;
}

