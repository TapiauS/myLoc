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

function validateBorrow(){
    if(isset($_SESSION['user'])&&isset($_GET['idborrow'])&&isset($_GET['iditem']))
        BorrowManager::validateBorrow(intval($_GET['idborrow']),intval($_GET['iditem']));
    else
        header('Location:index.php?target=error');
    require_once 'View/waitingBorrow.php';
}

function unvalidateBorrow(){
    if(isset($_SESSION['user'])&&isset($_GET['idborrow'])&&isset($_GET['iditem']))
        BorrowManager::refuseBorrow(intval($_GET['idborrow']),intval($_GET['iditem']));
    else
        header('Location:index.php?target=error');
    require_once 'View/waitingBorrow.php';
}



function deleteBorrow(){
    if(isset($_SESSION['user'])&&isset($_GET['idborrow'])):
        $borrow=BorrowManager::getBorrow(intval($_GET['idborrow']));
        var_dump($borrow->getStart()->format('Y-m-d')<(new DateTime())->format('Y-m-d'));
        if($borrow&&!($borrow->getStart()<(new DateTime())->format('Y-m-d')&&(new DateTime())->format('Y-m-d')<$borrow->getEnd())):
            $success=BorrowManager::deleteBorrow(intval($_GET['idborrow']));
            if($success)
                header('Location:index.php?target=allBorrow');
            else
                header('Location:index.php?target=error');
        else:
                header('Location:index.php?target=error');
        endif;
    endif;
}

function displayOneUserBorrow(){
    require_once 'View/allBorrowView.php';
}


function waitingBorrow(){
    require_once 'View/waitingBorrow.php';
}

