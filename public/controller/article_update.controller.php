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

if(!empty($_POST['article_published']) && $CURRENT_USER->isPublisher()){

    $article = new Article(intval($_GET['id']));
    $idPage = strval($_POST['page']);
    echo $idPage;
    $article->setPage($idPage);
    $article->setPublished(date("Y-m-d H:i:s"));
    $article->setPublisher(CURRENT_USER_ID);
    //var_dump($article);
    $res = $article->updateDatabase();
}

if($CURRENT_USER->isWriter()){
    $article = new Article(intval($_GET['id']));
	include view('article_update');
}else if($CURRENT_USER->isPublisher()){
    $pages = Page::getAll();
    $article = new Article(intval($_GET['id']));
    include view('article_update');
} else{
	echo "Vous n'avez pas les droits pour écrire un article.";
}
