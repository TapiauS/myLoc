<?php
require_once 'Model/Manager/Manager.php';
$controller = 'Controller';
$entities='Model/Entities';
$manager='Model/Manager';
foreach (glob("$controller/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("$entities/*.php") as $filename) {
    require_once $filename;
}

foreach (glob("$manager/*.php") as $filename) {
    require_once $filename;
}
session_start();
try{
    if(!empty($_GET)):
        if(isset($_GET['target'])):
            $target=$_GET['target'];
            switch($target){
                case 'connect':
                    connect();
                    break;
                case 'signin':
                    signIn();
                    break;
                case 'logout':
                    logout();
                    break;
                case 'allitem':
                    displayItems();
                    break;
                case 'deleteitem':
                    removeitem();
                    break;
                case 'allBorrow':
                    if(isset($_SESSION['user']))
                        displayOneUserBorrow();
                    else
                        header('Location:index.php?target=error');
                    break;
                case 'borrow':
                    if(isset($_SESSION['user']))
                        borrow();
                    else
                        header('Location:index.php?target=error');
                    break;
                case 'submitborrow':
                    submitBorrow();
                    break;
                case 'deleteborrow':
                    deleteBorrow();
                    break;
                case 'updateaccount':
                    updateaccount();
                    break;
                case 'admincategories':
                    if(isset($_SESSION['user'])&&$_SESSION['user']->getRole()===Role::ADMIN):
                        categories();
                        break;
                    else:
                        header('Location:index.php?target=error');
                    endif;
                case 'deleteaccount':
                    deleteaccount();
                    break;
                case 'userspace':
                    user();
                    break;
                case 'newitem':
                    addItem();
                    break;
                case 'updateitem':
                    updateItem();
                    break;
                case 'error':
                    error();
                    break;
                default;
            }
        endif;
    else:
        require_once 'View/home.php';
    endif;
}
catch(MylocException $me){
    error_log($me->getMessage());
    header('Location:index.php?target=error');
}
catch(MylocManagerException $mme){
    if($mme->getLvl()>0)
        error_log($mme->getMessage());
    header('Location:index.php?target=error');
}
catch(Exception $e){
    error_log($e->getMessage());
    header('Location:index.php?target=error');
}
