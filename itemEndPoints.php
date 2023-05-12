<?php
require_once 'Model/Manager/Manager.php';
$entities='Model/Entities';
$manager='Model/Manager';
foreach (glob("$entities/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("$manager/*.php") as $filename) {
    require_once $filename;
}
session_start();

$allitems=ItemManager::getAllitems();
$items=[];
if(isset($_GET['filter'])){
    $filter=$_GET['filter'];

    switch($filter){
        case 'myself':
            if(isset($_SESSION['user'])){
                foreach($allitems as $key=>$item){
                    if($item->getOwner()->getId()===$_SESSION['user']->getId())
                        array_push($items,$item); 
                }
            }
            break;
        case 'oneuser':
            if(isset($_GET['iduser'])){
                foreach($allitems as $key=>$item){
                    if($item->getOwner()->getId()===intval($_GET['iduser']))
                        array_push($items,$item); 
                }
            }
            break;
        case 'oneitem':
            if(isset($_GET['iditem'])){
                foreach($allitems as $key=>$item){
                    if($item->getId()===intval($_GET['iditem']))
                        array_push($items,$item); 
                }
            }
            break;
        default;
    }
    header('Content-Type: application/json');
    echo json_encode($items);
    exit;
}
else{
    header('Content-Type: application/json');
    echo json_encode($allitems);
    exit;
}


