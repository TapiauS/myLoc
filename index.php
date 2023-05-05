<?php

$controller = 'Controller';
$entities='Model/Entities';
$manager='Model/Manager';
session_start();

foreach (glob("$controller/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("$entities/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("$manager/*.php") as $filename) {
    require_once $filename;
}

if(!empty($_GET)):
    if(isset($_GET['target'])):
        $target=$_GET['target'];
        switch($target){
            case 'login':
                connect();
                break;
            case 'signin':
                signIn();
                break;
            case 'logout':
                logout();
                break;
            case 'item':
                displayItems();
                break;
            default;
        }
    endif;
else:
    require_once 'View/home.php';
endif;
