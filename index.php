<?php
session_start();
const CMS_FOLDER = 'cms/';
const FRONT_FOLDER = 'cms/front/';
require_once(CMS_FOLDER.'conf/top.php');
//require('./view/templates/head.php');
?>
<body>
<?php

function module($module_name){
    return 'cms/front/module/'.$module_name.'.php';
}
$meta   = new Meta();
define('SITE_TITLE',$meta->getTitle());

if ( empty($_GET['article']) ) {

	if ( CURRENT_PAGE == 'accueil' ) {
		$idPage = $meta->getHomepage();
		define('TITLE', 'Accueil');
		$page = new Page($idPage);
	}
    else{
		// chercher en BDD les articles liés à la page
		$idPage = Page::findPageId(CURRENT_PAGE);
		$page   = new Page($idPage);
		define('TITLE', $page->getTitle());
	}

	require_once(FRONT_FOLDER.'template/'.$page->getTemplate().'.php');
}
else { // on a demandé un article
	$id_art  = intval($_GET['article']);
	$article = new Article($id_art);
	define('TITLE', $article->getTitle());
	require_once(FRONT_FOLDER.'template/article.php');
}
?>
</body>
<?php
require(CMS_FOLDER.'view/templates/end.php');
?>
