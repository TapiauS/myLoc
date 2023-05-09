<?php
session_start();

$connected=isset($_SESSION['user']);

$data=['connected'=>$connected];

header('Content-Type: application/json');
echo json_encode($data);