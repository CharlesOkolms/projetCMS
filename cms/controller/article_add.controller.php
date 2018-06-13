<?php

if(!empty($_POST['article_add']) && $CURRENT_USER->isWriter()){
	$title = strval($_POST['title']);
	$content = strval($_POST['content']);

	$article = new Article();
	$article->setContent($content);
	$article->setTitle($title);
	$article->setWritten(date("Y-m-d H:i:s"));
	$article->setWriter(CURRENT_USER_ID);
	$res = $article->insertIntoDatabase();
}
if($CURRENT_USER->isWriter()){
	include view('article_form');
}else{
	echo "Vous n'avez pas les droits pour créer un article.";
}
