<?php require_once 'View/Partial/header.php'; ?>
<h1> Bienvenue sur MyloC <?= isset($_SESSION['user'])?$_SESSION['user']->getPseudo():"";?></h1>
<?php require_once 'View/Partial/footer.php';


