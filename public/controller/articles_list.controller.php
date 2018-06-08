<?php

if($CURRENT_USER->isAdmin()){

	$liste = Article::getAll();
    //var_dump($liste);
	include view('articles_list');


}
else {
	echo "Seuls les admins peuvent voir les utilisateurs.";
}
