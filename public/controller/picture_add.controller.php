<?php

if ( !empty($_POST['gallery_add']) && $CURRENT_USER->isWriter() ) {
	$content = (!empty(strval($_POST['description'])))?strval($_POST['description']):null;
	$title = (!empty(strval($_POST['title'])))?strval($_POST['title']):null;

	if(!empty($title) && !empty($content)) {
		$gallery = new Gallery();
		$gallery->setTitle($title);
		$gallery->setDescription($content);
		$gallery->setCreator(CURRENT_USER_ID);

		$res = $gallery->insertIntoDatabase();
		if ( $res === true ) {
			echo '<p>Ajout réussi !</p><br>';
		}
		else {
			echo '<p>Ajout raté !</p><br>';
			var_dump($res);
		}
	}else{
		echo '<p>Info manquante !</p><br>';
	}
}
if ( $CURRENT_USER->isWriter() ) {
	include view('gallery_form');
}
else {
	echo "Vous n'avez pas les droits pour créer une galerie.";
}

