<?php

if(!empty($_POST['page_add']) && $CURRENT_USER->isAdmin()){
	$title = strval($_POST['title']);
	$style = strval($_POST['style']);
	$template = strval($_POST['template']);

	$page = new Page();
	$page->setCreator(CURRENT_USER_ID);
	$page->setTitle($title);
	$page->setTemplate($template);
	$page->setStyle($style);
	$res = $page->insertIntoDatabase();
}
if($CURRENT_USER->isAdmin()){
	include view('page_form');
}else{
	echo "Vous n'avez pas les droits pour créer une page.";
}

