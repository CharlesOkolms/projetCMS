<?php

if(!empty($_POST['user_update']) && $CURRENT_USER->isAdmin()){
    $modifuser = new User(intval($_POST["id_user"]));
    $modifuser->setWriter(0);
    $modifuser->setPublisher(0);
    $modifuser->setAdmin(0);
    foreach ($_POST["rights"] as $droit){
        $modifuser->{'set'.ucfirst(strtolower($droit))}(1);
    }
    $modifuser->updateDatabase();
}

if($CURRENT_USER->isAdmin()){
	$liste = User::getAll();

	include view('user_list');
	// en attendant la vue, un var_dump :

}
else {
    echo "<h1> Accès Interdit </h1><p>Seuls les admins peuvent voir les utilisateurs.</p>";
}
