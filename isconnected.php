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

$connected=isset($_SESSION['user']);

$data=['connected'=>$connected];



header('Content-Type: application/json');
echo json_encode($data);