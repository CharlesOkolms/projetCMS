<?php
echo '<pre>';
if(!empty($_POST['article_add'])){
	$title = strval($_POST['title']);
	$content = strval($_POST['article']);

	$article = new Article();
	$article->setContent($content);
	$article->setTitle($title);
	$article->setWritten(date("Y-m-d H:i:s"));
	$article->setWriter(1);
	$res = $article->insertIntoDatabase();
}

echo '</pre>';
include view('article_form');
