<?php

function deleteaccount(){
    if(isset($_SESSION['user'])):
        $success=UserManager::deleteUser($_SESSION['user']->getId());
        if($success)
            logout();
        else
            header("Location:index.php?target=error&errortype=stillborrowing");
    else:
        header("Location:index.php?target=error");
    endif;
}

function updateaccount(){
    if(isset($_SESSION['user'])):
        if(isset($_POST)&&!empty($_POST)):
            $user=$_SESSION['user'];
            if($user->getRole()===Role::ADMIN):
                if(isset($_GET['iduser'])):
                    define("PSEUDO",sanitize($_POST["pseudo"]));
                    define('PSEUDOREGEX','/^[a-z]{3,10}$/');
                    define("ADRESS",sanitize($_POST["adress"]));
                    define("TOWN",sanitize($_POST['town']));
            
                    $success=preg_match(PSEUDOREGEX,PSEUDO)&&preg_match(MDPREGEX,PASSWORD);
                    if($success):
                        $udpated=UserManager::updateUser($_GET['iduser'],PSEUDO,ADRESS,TOWN);
                        if($udpated):
                            header("Location:index.php");
                        else:
                            header("Location:index.php?target=error&errortype=wronglog&cause=notavailable");
                        endif;
                    else:
                        header("Location:index.php?target=error&errortype=wronglog&cause=forbiden");
                    endif;
                else:
                    define("PSEUDO",sanitize($_POST["pseudo"]));
                    define('PSEUDOREGEX','/^[a-z]{3,10}$/');
                    define("ADRESS",sanitize($_POST["adress"]));
                    define("TOWN",sanitize($_POST['town']));
            
                    $success=preg_match(PSEUDOREGEX,PSEUDO)&&preg_match(MDPREGEX,PASSWORD);
                    if($success):
                        $udpated=UserManager::updateUser($_SESSION['iduser']->getId(),PSEUDO,ADRESS,TOWN);
                        if($udpated):
                            header("Location:index.php");
                        else:
                            header("Location:index.php?target=error&errortype=wronglog&cause=notavailable");
                        endif;
                    else:
                        header("Location:index.php?target=error&errortype=wronglog&cause=forbiden");
                    endif;
                endif;
            else:
                define("PSEUDO",sanitize($_POST["pseudo"]));
                define('PSEUDOREGEX','/^[a-z]{3,10}$/');
                define("ADRESS",sanitize($_POST["adress"]));
                define("TOWN",sanitize($_POST['town']));
        
                $success=preg_match(PSEUDOREGEX,PSEUDO)&&preg_match(MDPREGEX,PASSWORD);
                if($success):
                    $udpated=UserManager::updateUser($_SESSION['iduser']->getId(),PSEUDO,ADRESS,TOWN);
                    if($udpated):
                        header("Location:index.php");
                    else:
                        header("Location:index.php?target=error&errortype=wronglog&cause=notavailable");
                    endif;
                else:
                    header("Location:index.php?target=error&errortype=wronglog&cause=forbiden");
                endif;
            endif;
        endif;
        require_once 'View/updateaccount.php';
    else:
        header('Location:index.php?target=error');
    endif;   
}

function connect(){
    if(isset($_POST)&&!empty($_POST)):
        define("PSEUDO",sanitize($_POST["pseudo"]));
        define("PASSWORD",sanitize($_POST["password"]));
        define("PSEUDOREGEX","/^[a-zA-Z'-]+$/");
        $user=UserManager::connectUser(PSEUDO,PASSWORD);
        if(!$user){
            $_SESSION["user"]=$user;
            header("Location:index.php");
        }
        else
        {
            header("Location:index.php?target=error&errortype=wronglog");
            exit();
        }
    endif;
    
    require 'View/loginView.php';
}

function logout(){
    unset($_SESSION['user']);
    header("Location:index.php");
}

function signIn(){
    if(isset($_POST)&&!empty($_POST)):
        define("PSEUDO",sanitize($_POST["pseudo"]));
        define("PASSWORD",sanitize($_POST["password"]));
        define('PSEUDOREGEX','/^[a-z]{3,10}$/');
        define('MDPREGEX','/^.{10,}$/');
        define("ADRESS",sanitize($_POST["adress"]));
        define("TOWN",sanitize($_POST['town']));

        $success=preg_match(PSEUDOREGEX,PSEUDO)&&preg_match(MDPREGEX,PASSWORD);
        if($success):
            $user=UserManager::createUser(PSEUDO,PASSWORD,ADRESS,TOWN);
            if(!is_null($user)):
                $_SESSION["user"]=$user;
                header("Location:index.php");
            else:
                header("Location:index.php?target=error&errortype=wronglog&cause=notavailable");
            endif;
        else:
            header("Location:index.php?target=error&errortype=wronglog&cause=forbiden");
        endif;
    endif;
    require 'View/signInView.php';
}
