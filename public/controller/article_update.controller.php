<?php

if(!empty($_POST['article_update']) && $CURRENT_USER->isWriter()){
	$title = strval($_POST['title']);
	$content = strval($_POST['content']);

	$article = new Article(intval($_GET['id']));
	$article->setContent($content);
	$article->setTitle($title);
	$article->setWritten(date("Y-m-d H:i:s"));
	$article->setWriter(CURRENT_USER_ID);
	$res = $article->updateDatabase();
}
if($CURRENT_USER->isWriter()){
    $article = new Article(intval($_GET['id']));
	include view('article_update');
}else{
	echo "Vous n'avez pas les droits pour écrire un article.";
}
