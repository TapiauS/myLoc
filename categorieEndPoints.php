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

$categories=ItemCategoryManager::getAllCategories();
header('Content-Type: application/json');
echo json_encode($categories);

