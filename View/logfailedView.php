<?php

require_once 'View/Partial/header.php';
if(isset($_GET['cause']))
    if($_GET['cause']==='notavailable')
        echo "<p>Mot de passe ou pseudo non disponible</p>"; 
    else
        echo "<p>Mot de passe ou pseudo non conforme</p>";
else
    echo "<p>Mot de passe ou pseudo incorrect</p>";
require_once 'View/Partial/footer.php';