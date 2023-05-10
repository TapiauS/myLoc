<form method="post" action="" enctype="multipart/form-data">>
    <input type="text" id="item_name" name="name" placeholder="Nom" required><br><br>

    <textarea id="description" name="description" rows="4" cols="50" placeholder="Description"></textarea><br><br>

    <select id="item_type" name="type" required>
        <option value="" disabled selected>Choisir le type d'objet</option>

    </select>

    <label for="item_image">Photo de l'objet:</label>
    <input type="file" id="item_image" name="item_image" accept="image/*" ><br><br>

    <input type="submit" value="Submit">
</form>