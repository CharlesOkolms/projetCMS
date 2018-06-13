<?php
if ( !empty($_POST['template_add']) && $CURRENT_USER->isAdmin()) {
	$title       = (!empty(strval($_POST['title']))) ? strval($_POST['title']) : NULL;
	$temp = new Template();
	$temp->setName($title);
	$temp->setCreator(CURRENT_USER_ID);
	$temp->insertIntoDatabase();
}
if ( $CURRENT_USER->isAdmin() ) {
	include view('template_add');
}
else {
	echo "Vous n'avez pas les droits pour ajouter un template.";
}
