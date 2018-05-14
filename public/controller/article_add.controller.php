<?php

if(!empty($_POST['article_add'])){
	$title = strval($_POST['title']);
	$content = strval($_POST['article']);

	$article = new Article();
	$article->setContent($content);
	$article->setTitle($title);
	$article->setWritten(date("Y-m-d H:i:s"));
	$article->setWriter(CURRENT_USER_ID);
	$res = $article->insertIntoDatabase();
}

include view('article_form');
