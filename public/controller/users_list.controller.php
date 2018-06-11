<?php

if(!empty($_POST['user_update']) && $CURRENT_USER->isAdmin()){
    $modifuser = new User(intval($_POST["id_user"]));
    if(!empty($_POST["rights"]["writer"])) {
        $modifuser->setWriter(true);
    }
    if(!empty($_POST["rights"]["publisher"])) {
        $modifuser->setPublisher(true);
    }
    if(!empty($_POST["rights"]["admin"])) {
        $modifuser->setAdmin(true);
    }
    $modifuser->updateDatabase();
}

if($CURRENT_USER->isAdmin()){
	$liste = User::getAll();

	include view('user_list');
	// en attendant la vue, un var_dump :
	//var_dump($liste);

}
else {
    echo "<h1> Accès Interdit </h1><p>Seuls les admins peuvent voir les utilisateurs.</p>";
}
