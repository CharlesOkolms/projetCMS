<?php
if(!empty($_POST['page_deleted']) && $CURRENT_USER->isAdmin()){

    $id = intval($_POST['idPage']);
    $page = new Page($id);
    $page->setDeleted(date("Y-m-d H:i:s"));
    $page->setDeleter(CURRENT_USER_ID);
    $page->updateDatabase();
}

if($CURRENT_USER->isAdmin())
{
	$liste = Page::getAll();
    //var_dump($liste);
	include view('pages_list');
}
else
{
	echo "Seuls les admins peuvent voir les utilisateurs.";
}
