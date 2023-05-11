<?php


function categories(){
    if(!empty($_POST)&&!isset($_POST['catlist'])){
        define('CATEGORYREGEX','/[a-z]$/');
        define('CATEGORYNAME',$_POST['name']);
        define('POINTS',intval($_POST['points']));
        $success=preg_match(CATEGORYREGEX,CATEGORYNAME)&&(POINTS>0);
        if($success):
            ItemCategoryManager::createCategory(CATEGORYNAME,POINTS);
            header('Location:index.php');
        else:
            header('Location:index.php?target=error&errortype=caterror');
        endif;
    }
    else if(!empty($_POST)){
        define('CATEGORYREGEX','/[a-z]$/');
        define('CATEGORYNAME',$_POST['nameupdate']);
        define('POINTS',intval($_POST['pointsupdate']));
        $success=preg_match(CATEGORYREGEX,CATEGORYNAME)&&POINTS>0;
        var_dump($success);
        if($success):
            ItemCategoryManager::updateCategory(CATEGORYNAME,POINTS,$_POST['type']);
            header('Location:index.php?target=admincategories');
        else:
            // header('Location:index.php?target=error&errortype=caterror');
        endif;
    }
    require_once 'View/categoriesGestionView.php';
}

