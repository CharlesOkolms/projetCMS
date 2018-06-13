<?php



?>



<h1>Mon compte</h1>

<h2>Mes informations générales</h2>

<div class="moncompte">
	<div style="display:none;"><span>Id :</span> <span><?=$user->getId()?></span></div>
	<div><span class="lbl">Pseudo :</span> <span class="value"><?=$user->getNickname()?></span>	</div>
	<div><span class="lbl">Nom :</span> <span class="value"><?=$user->getLastname()?></span>	</div>
	<div><span class="lbl">Prenom :</span> <span class="value"><?=$user->getFirstname()?></span></div>
	<div><span class="lbl">E-mail :</span> <span class="value"><?=$user->getEmail()?></span>	</div>
</div>

<?php
    var_dump($users);

//    print_r($article);


    ?>
