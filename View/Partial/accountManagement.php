<div class='d-flex align-items-center justify-content-center'>
    <div class='row' id='Accountmanagement'>
        <p>Points <?=$_SESSION['user']->getPoints()?></p>
        <a href='index.php?target=updateaccount' class='btn btn-primary mt-1'>Mettre a jour ses informations</a>
        <a href='index.php?target=deleteaccount' class='btn btn-primary mt-1'>Supprimer le compte</a>
    </div>
</div>
<div class='row' id='itemmanagement'>
    <div class='col-12 mt-5'>
        <div class='d-flex align-items-center justify-content-center'>
            <a href='index.php?target=newitem' class='btn btn-primary'>Ajouter un objet</a>
        </div>
    </div>
    <div id='carddisplayer' class='row mt-1'>
    </div>
</div>
<script src='View/Js/accountmanagement.js'></script>