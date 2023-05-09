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

if(isset($_GET['oneuser'])&&isset($_GET['iduser'])&&boolval($_GET['oneuser'])):
    $allitems=ItemManager::getAllitems();
    $items=[];
    foreach($allitems as $key=>$item){
        if($item->getOwner()->getId()===intval($_GET['iduser']))
            array_push($items,$item); 
    }
    header('Content-Type: application/json');
    echo json_encode($items);
else:
    $allitems=ItemManager::getAllitems();
    header('Content-Type: application/json');
    echo json_encode($allitems);
endif;