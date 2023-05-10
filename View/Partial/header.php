<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php 
                        if(array_key_exists('user',$_SESSION)):?>
                            <li class="nav-item">
                                <button id="disconnect">Se deconnecter</button>
                            </li>
                            <?php if($_SESSION['user']->getRole()===Role::ADMIN):?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/myLoc/index.php?target=admincategories">Gerer les catégories</a>
                                </li>
                            <?php endif;?>
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
                            <a class="nav-link" href="/myLoc/index.php?target=allBorrow">Tout les emprunts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/myLoc/index.php">Acceuil</a>
                        </li>
                        <?php if(isset($_GET['target'])&&$_GET['target']==='item'):?>
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
