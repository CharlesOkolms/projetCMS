<?php

?>

<div id="picture_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre" required />
        <textarea title="description" name="description" placeholder="Description" required></textarea>
        <input type="file" name="picture" required />
        <input title="Save" type="submit" name="picture_add" value="Ajouter" class="btn btn-primary navbar-btn"/>
    </form>
</div>