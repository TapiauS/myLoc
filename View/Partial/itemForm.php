<form method="post" action="" enctype="multipart/form-data">
    <div class="d-flex justify-content-center">
        <div class="container-md">
            <div class="row">
                <input type="text" id="item_name" name="name" placeholder="Nom" required class="col-12">
                <textarea id="description" name="description" rows="4" cols="50" placeholder="Description"></textarea>
                <select id="item_type" name="type" required class="col-12">
                    <?= isset($_SESSION['user'])&&isset($_GET['target'])&&$_GET['target']==='updateitem'?'<option value="" id="default"></option>':"<option value='' disabled selected>Choisir le type d'objet</option>";?>
                </select>
                <div class="col-12">
                    <label for="item_image">Photo de l'objet:</label>
                    <?= isset($_SESSION['user'])&&isset($_GET['target'])&&$_GET['target']==='updateitem'?'<img src="" alt="" id="picture">':''?>
                    <input type="file" id="item_image" name="picture" accept="image/*" >
                </div>
                <div class="col-12 justify-content-center">
                    <button type="submit" value="Submit" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </div>
</form>