<form action='' method='post' class="mt-5" id='updateform'>
    <fieldset>
        <legend>Modifier une catégorie</legend>
        <select id="catlist" name="type" required>
            <option value="" disabled selected>Choisir la catégorie</option>

        </select>
        <input name='nameupdate' placeholder="Nom" id='updatename'>
        <input name="pointsupdate" placeholder="Points" id='updatepoints'>
        <button type="submit" id='submit'>Modifier</button>
    </fieldset>
</form>
