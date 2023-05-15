<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Assets/Icons/logo.ico">
    <title>MyLoc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php 
                        if(array_key_exists('user',$_SESSION)):?>
                            <li class="nav-item">
                                <button class='btn btn-primary'id="disconnect">Se deconnecter</button>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/myLoc/index.php?target=userspace">Espace utilisateur</a>
                            </li>
                            <?php if($_SESSION['user']->getRole()===Role::ADMIN):?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/myLoc/index.php?target=admincategories">Gerer les catégories</a>
                                </li>
                            <?php endif;?>
                            <li class="nav-item">
                                <a class="nav-link" href="/myLoc/index.php?target=waitingborrow"></a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/myLoc/index.php?target=connect">Se Connecter</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/myLoc/index.php?target=signin">Creer un compte</a>
                            </li>
                        <?php   
                        endif;
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/myLoc/index.php?target=allBorrow">Mes emprunts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/myLoc/index.php?target=allitem">Tout les objets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/myLoc/index.php">Accueil</a>
                        </li>
                        <?php if(isset($_GET['target'])&&$_GET['target']==='allitem'):?>
                            <li class="nav-item dropdown">
                                <select id="catlist" class="form-control">
                                    <option value="">Toutes catégories</option>
                                </select>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
