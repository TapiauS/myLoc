<?php

function error(){
    if(isset($_GET['errortype'])):
        switch($_GET['errortype']){
            case 'wronglog': 
                require_once 'View/logfailedView.php';
                break;
            case 'invaliditem':
                require_once 'View/itemCreationFailedView.php';
                break;
            case 'deleteitem':
                require_once 'View/itemDeletionFailedView.php';
                break;
            case 'stillborrowing':
                require_once 'View/accountDeleteFailedView.php';
                break;
            case 'caterror':
                require_once 'View/categoriefailView.php';
                break;
            default;
        }
    else:
        require_once 'View/errorView.php';
    endif;
}