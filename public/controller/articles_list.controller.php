<?php
if(!empty($_POST['article_deleted'])){

    var_dump(intval($_POST['idArticle']));
    $id = intval($_POST['idArticle']);
    echo $id;
    $article = new Article($id);
    var_dump($article);
    echo "</br>";
    $article->setDeleted(date("Y-m-d H:i:s"));
    var_dump($article);
    echo "</br>";
    $article->setDeleter(CURRENT_USER_ID);
    var_dump($article);
    echo "</br>";
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
