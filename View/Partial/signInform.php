<form action="" method="post">
    <input type="text" name="pseudo" placeholder="Pseudo" <?=!($_GET['target']==='updateaccount'&&isset($_SESSION['user']))?'':'value='.$_SESSION['user']->getPseudo()?>>
    <?= !($_GET['target']==='updateaccount')?'<input type="password" name="password" placeholder="Mot de Passe">':''?>
    <input type="text" name="adress" placeholder="Ville(falcultatif)" <?=!($_GET['target']==='updateaccount'&&isset($_SESSION['user']))?'':'value='.$_SESSION['user']->getAdress()?>>
    <input type="text" name="town" placeholder="Adresse(falcultatif)" <?=!($_GET['target']==='updateaccount'&&isset($_SESSION['user']))?'':'value='.$_SESSION['user']->getTown()?>>
    <button type="submit"><?= !($_GET['target']==='updateaccount')?'Creer un compte':'Mettre a jour'?></button>
</form>
