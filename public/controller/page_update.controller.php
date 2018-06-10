<?php

if(!empty($_POST['page_update']) && $CURRENT_USER->isWriter()){
	$title = strval($_POST['title']);
	$content = strval($_POST['content']);

	$article = new Page(intval($_GET['id']));
	$page->setContent($content);
	$page->setTitle($title);
	$res = $page->updateDatabase();
}
if($CURRENT_USER->isWriter()){
    $page = new Page(intval($_GET['id']));
    //var_dump($page);
	include view('page_update');
}else{
	echo "Vous n'avez pas les droits pour écrire une page.";
}
