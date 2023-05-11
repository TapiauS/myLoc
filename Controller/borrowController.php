<?php

function borrow(){
    require_once 'View/borrowView.php';
}

function submitBorrow(){
    if(!empty($_POST)):
        define('DATEREGEX','/\b\d{4}-\d{2}-\d{2}\b/');
        $correct=preg_match(DATEREGEX,sanitize($_POST['start']))&&preg_match(DATEREGEX,sanitize($_POST['end']));
        if(isset($_GET['iditem']))
            $item=ItemManager::getItem($_GET['iditem']);
        else
            header('Location:index.php?target=error');
        if($correct):
            define('START',DateTime::createFromFormat('Y-m-d',sanitize($_POST['start'])));
            define('END',DateTime::createFromFormat('Y-m-d',sanitize($_POST['end'])));
            if($available=isavailable($item,START,END)&&END>START):
                $response = array('success' => true, 'code' => 'default');
                header('Content-Type: application/json');
                echo json_encode($response);
                BorrowManager::addBorrow($item,$_SESSION['user'],START,END);
            else:
                if(!$available):
                    $response = array('success' => false, 'code' => 'notavailable');
                    header('Content-Type: application/json');
                    echo json_encode($response);
                else:
                    $response = array('success' => false, 'code' => 'default');
                    header('Content-Type: application/json');
                    echo json_encode($response);
                endif;
            endif;
        else:
            header('Location:index.php?target=error');
        endif;   
    endif; 
}

function displayAllBorrow(){

}

function displayOneUserBorrow(){
    require_once 'View/allBorrowView.php';
}

function displayOneItemBorrow(){
    
}