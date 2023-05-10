<?php


function newcategories(){
    if(!empty($_POST)){
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
    require_once 'View/categoriesGestionView.php';
}