<form action="" method="post">
    <input type="text" name="pseudo" placeholder="Pseudo">
    <?= !($_GET['target']==='updateaccount')?'<input type="password" name="password" placeholder="Mot de Passe">':''?>
    <input type="text" name="adress" placeholder="Ville(falcultatif)">
    <input type="text" name="town" placeholder="Adresse(falcultatif)">
    <button type="submit">Creer un compte</button>
</form>
