<?php

function addItem(){
    if(isset($_SESSION['user'])):
        if(!empty($_POST)):
            define('NAME',sanitize($_POST['name']));
            define('DESCR',sanitize($_POST['description']));
            $validfile=true;
            if(!empty($_FILES['picture']['name'])):
                $allowedExtensions = ['jpg', 'png'];
                $prefix=pathinfo($_FILES['picture']['name'], PATHINFO_FILENAME);
                $extension=pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $validfile=in_array($extension, $allowedExtensions);
                define('PICTURE',sanitize(uniqid($prefix).$extension));
            else:
                define('PICTURE',null);
            endif;
            define('TYPE',sanitize($_POST['type']));
            $success=!is_null(NAME)&&!is_null(TYPE)&&$validfile;
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
                    header('Location:index.php?target=userspace');
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
    require_once 'View/createItemView.php';    
}

function removeItem(){
    if(isset($_SESSION['user'])):
        if(isset($_GET['iditem'])):
            if(isavailable(ItemManager::getItem($_GET['iditem']),new DateTime(),new DateTime())&&ItemManager::deleteItem($_GET['iditem']))
                header('Location:index.php?target=userspace');
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

function updateItem(){
    if(isset($_SESSION['user'])&&isset($_GET['iditem'])):
        if(!empty($_POST)):
            define('NAME',sanitize($_POST['name']));
            define('DESCR',sanitize($_POST['description']));
            $validfile=true;
            if(!empty($_FILES['picture']['name'])):
                $allowedExtensions = ['jpg', 'png'];
                $prefix=pathinfo($_FILES['picture']['name'], PATHINFO_FILENAME);
                $extension=pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $validfile=in_array($extension, $allowedExtensions);
                define('PICTURE',sanitize(uniqid($prefix).$extension));
            else:
                define('PICTURE',ItemManager::getItem(intval($_GET['iditem']))->getPictureName());
            endif;
            define('TYPE',intval(sanitize($_POST['type'])));
            $success=!is_null(NAME)&&!is_null(TYPE)&&$validfile;
            if($success):
                $item=ItemManager::updateItem(NAME,DESCR,TYPE,$_SESSION['user']->getId(),PICTURE,intval($_GET['iditem']));
                if($item):
                    $upload_dir = 'Images';
                    if($_FILES['picture']['error'] == 0){
                        $currentLocation = $_FILES['picture']['tmp_name'];
                        $name = PICTURE;
                        $uploadLocation = "$upload_dir/$name";
                        move_uploaded_file($currentLocation, $uploadLocation);
                    }
                    header('Location:index.php?target=userspace');
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
    require_once 'View/updateItemView.php';
}