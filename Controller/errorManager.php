<?php

function error(){
    if(isset($_GET['errortype'])):
        switch($_GET['errortype']){
            case 'wronglog': 
                require_once 'View/logfailedView.php';
                break;
            case 'invaliditem':
                require_once 'View/itemFailedView.php';
            case 'deleteitem':
                require_once 'View/itemFailedView.php';
            default;
        }
    else:
        require_once 'View/errorView.php';
    endif;
}