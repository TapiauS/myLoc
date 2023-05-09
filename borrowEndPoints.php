<?php
$entities='Model/Entities';
$manager='Model/Manager';
foreach (glob("$entities/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("$manager/*.php") as $filename) {
    require_once $filename;
}
session_start();

try{
    if(!isset($_GET['iditem'])):
        $borrows=BorrowManager::getBorrowedItem($_SESSION['user']);
    else:
        $borrows=BorrowManager::getAllBorrow(ItemManager::getItem($_GET['iditem']));
    endif;
    header('Content-Type: application/json');
    echo json_encode($borrows);
}
catch(MylocManagerException $mme){
    if($mme->getLvl()>0)
        error_log($mme->getMessage());
}

