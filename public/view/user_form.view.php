<?php

?>



<div class="user_add_block" id="user_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="nickname" placeholder="Pseudo" />
        <input type="text" name="firstname" placeholder="Prénom" />
        <input type="text" name="lastname" placeholder="Nom" />
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Mot de passe">

        <div id="droit_utilisateur">
            <input type="checkbox" id="writer" name="writer">
            <label for="writer">Rédacteur</label>
        </div>
        <div id="droit_utilisateur">
            <input type="checkbox" id="publisher" name="publisher">
            <label for="publisher">Publicateur</label>
        </div>
        <div id="droit_utilisateur">
            <input type="checkbox" id="admin" name="admin">
            <label for="admin">Administrateur</label>
        </div>

        <input title="Save the user" type="submit" name="user_add" value="Ajouter" class="btn btn-primary navbar-btn" />
    </form>
</div>

