<?php

if($CURRENT_USER->isAdmin()){

	$liste = User::getAll();

	include view('user_list');
	// en attendant la vue, un var_dump :
	//var_dump($liste);

}
else {
    echo "<h1> Accès Interdit </h1><p>Seuls les admins peuvent voir les utilisateurs.</p>";
}
