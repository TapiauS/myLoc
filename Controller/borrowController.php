<?php

function borrow(){
    if(!empty($_POST)):
        $now=new DateTime();
        define('DATEREGEX','/\b\d{4}-\d{2}-\d{2}\b/');
        $correct=preg_match(DATEREGEX,sanitize($_POST['start']))&&preg_match(DATEREGEX,sanitize($_POST['end']));
        if($_GET['iditem'])
            $item=ItemManager::getItem($_GET['iditem']);
        else
            header('Location:index.php?target=error');
        if($correct):
            define('START',DateTime::createFromFormat('Y-m-d',sanitize($_POST['start'])));
            define('END',DateTime::createFromFormat('Y-m-d',sanitize($_POST['end'])));
            if($available=isavailable($item,START,$now)&&END>START):
                $response = array('success' => true, 'code' => '');
                echo json_encode($response);
                BorrowManager::addBorrow($item,$_SESSION['user'],START,END);
                header('Location:index.php?target=allBorrow');
            else:
                if(!$available):
                    $response = array('success' => false, 'code' => 'notavailable');
                    echo json_encode($response);
                else:
                    $response = array('success' => false, 'code' => '');
                    echo json_encode($response);
                    header('Location:index.php?target=error');
                endif;
            endif;
        else:
            header('Location:index.php?target=error');
        endif;   
    endif; 
    require_once 'View/borrowView.php';
}

function displayAllBorrow(){

}

function displayOneUserBorrow(){
    require_once 'View/allBorrowView.php';
}

function displayOneItemBorrow(){
    
}