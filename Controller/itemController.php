<?php

function addItem(){
    if(isset($_SESSION['user'])):
        if(!empty($_POST)):
            define('NAME',sanitize($_POST['name']));
            define('DESCR',sanitize($_POST['description']));
            if(!empty($_FILES['picture']['name'])):
                $prefix=pathinfo($_FILES['picture']['name'], PATHINFO_FILENAME);
                $extension=pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                define('PICTURE',sanitize(uniqid($prefix).$extension));
            else:
                define('PICTURE',null);
            endif;
            define('TYPE',sanitize($_POST['type']));
            $success=!is_null(NAME)&&!is_null(TYPE);
            if($success):
                $item=ItemManager::createItem(NAME,DESCR,TYPE,$_SESSION['user']->getId(),PICTURE);
                if($item):
                    $upload_dir = 'Images';
                    if($_FILES['picture']['error'] == 0){
                        $currentLocation = $_FILES['picture']['tmp_name'];
                        $name = PICTURE;
                        $uploadLocation = "$upload_dir/$name";
                        move_uploaded_file($currentLocation, $uploadLocation);
                    }
                    header('Location:index.php');
                else:
                    header('Location:index.php?target=error');
                endif;
            else:
                header('Location:index.php?target=error&errortype=invaliditem');
            endif;
        endif;
    else:
        header('Location:index.php?target=error');
    endif;    
}

function removeItem(){
    if(isset($_SESSION['user'])):
        if(isset($_GET['idit'])):
            if(isavailable(ItemManager::getItem($_GET['idit']),new DateTime())&&ItemManager::deleteItem($_GET['idit']))
                header('Location:index.php?target=items');
            else
                header('Location:index.php?target=error&errortype=deleteitem');
        else:
            header('Location:index.php?target=error');
        endif;
    else:
        header('Location:indes.php?target=error');
    endif;
}

function displayItems(){
    require_once 'View/itemsView.php';
}