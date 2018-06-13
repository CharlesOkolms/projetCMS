<?php
if(!empty($_POST['article_deleted'])){

    $id = intval($_POST['idArticle']);
    $article = new Article($id);
    $article->setDeleted(date("Y-m-d H:i:s"));
    $article->setDeleter(CURRENT_USER_ID);
    $article->updateDatabase();
}

if($CURRENT_USER->isAdmin()||$CURRENT_USER->isWriter()||$CURRENT_USER->isPublisher()){

	$liste = Article::getAll();
    //var_dump($liste);
	include view('articles_list');


}
else {
	echo "Accès Interdit.";
}
