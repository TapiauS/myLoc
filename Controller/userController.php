<?php
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
