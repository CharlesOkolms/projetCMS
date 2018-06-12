<?php

if ( !empty($_POST['picture_add']) && !empty($_FILES)) {
	$description = (!empty(strval($_POST['description'])))?strval($_POST['description']):null;
	$title       = (!empty(strval($_POST['title'])))?strval($_POST['title']):null;

	$picfile = $_FILES['picture'];
	$filename = $picfile['name'];

	if ( strstr($picfile['type'], 'image') ) {
		$ok = true;
	}
	else {
		$ok = false;
	}

	if ( $ok === true && !empty($title) && !empty($description) ) {
		$picture = new Picture();
		$picture->setTitle($title);
		$picture->setDescription($description);
		$picture->setFilename($filename);
		$picture->setUploader(CURRENT_USER_ID);

		$ext = explode('.', $filename);
		$ext = end($ext);

		$picture->setExtension($ext);
		$picture->setUploader(CURRENT_USER_ID);



		$res = $picture->insertIntoDatabase();
		if ( $res === true ) {
			echo '<p>Ajout réussi !</p><br>';
			$res2 = move_uploaded_file($picfile['tmp_name'],PATH_PICTURE.$picture->getId().'.'.$picture->getExtension());
			if($res2 === false){
				echo '<p>Upload raté ! Problème de stockage du fichier...</p><br>';
			}
		}
		else {
			echo '<p>Ajout raté !</p><br>';
		}

	}
	else {
		echo '<p>Info manquante !</p><br>';
	}
}
if ( $CURRENT_USER->isWriter() || $CURRENT_USER->isPublisher() ) {
	include view('picture_form');
}
else {
	echo "Vous n'avez pas les droits pour ajouter une image.";
}

