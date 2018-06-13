<?php

if(!empty($_POST['page_update']) && $CURRENT_USER->isWriter()){
    $title = strval($_POST['title']);
    $style = strval($_POST['style']);
    $template = strval($_POST['template']);

    $page = new Page(intval($_GET['id']));
	$page->setTitle($title);
    $page->setTemplate($template);
    $page->setStyle($style);

	$res = $page->updateDatabase();
}
if($CURRENT_USER->isWriter()){
    $page = new Page(intval($_GET['id']));
    //var_dump($page);
	include view('page_update');
}else{
	echo "Vous n'avez pas les droits pour écrire une page.";
}
