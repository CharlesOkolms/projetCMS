<?php
if ( !empty($_POST['style_add']) && $CURRENT_USER->isAdmin()) {
	$title       = (!empty(strval($_POST['title']))) ? strval($_POST['title']) : NULL;
	$css = (!empty(strval($_POST['style']))) ? strval($_POST['style']) : NULL;
	$style = new Style();
	$style->setName($title);

	$style->insertIntoDatabase();
	file_put_contents(FRONT_FOLDER.'style/'.$style->getId().'.css', $css);

}
if ( $CURRENT_USER->isAdmin() ) {
	include view('style_add');
}
else {
	echo "Vous n'avez pas les droits pour ajouter un style.";
}
