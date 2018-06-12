<?php

?>



<div class="user_add_block" id="user_add">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="nickname" placeholder="Pseudo" value="<?php echo $user->getNickname();?>"/>
        <input type="text" name="firstname" placeholder="Prénom" value="<?php echo $user->getFirstname();?>"/>
        <input type="text" name="lastname" placeholder="Nom" value="<?php echo $user->getLastname();?>"/>
        <input type="text" name="email" placeholder="Email" value="<?php echo $user->getEmail();?>"/>
        <input type="password" name="password" placeholder="Mot de passe" >

        <input title="Save the user" type="submit" name="user_update" value="Modifier" class="btn btn-primary navbar-btn" />
    </form>
</div>

