<?php

if($CURRENT_USER->isAdmin()){

	$liste = Page::getAll();
    //var_dump($liste);
	include view('pages_list');


}
else {
	echo "Seuls les admins peuvent voir les utilisateurs.";
}
