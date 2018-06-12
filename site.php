<?php
session_start();
const CMS_FOLDER = 'public/';
const FRONT_FOLDER = 'public/front/';
require_once(CMS_FOLDER.'conf/top.php');
//require('./view/templates/head.php');
?>
<body>
<?php

function module($module_name){
    return 'public/front/module/'.$module_name.'.php';
}

if(CURRENT_PAGE !== 'accueil'){
	// chercher en BDD les articles liés à la page
    $idPage = Page::findPageId(CURRENT_PAGE);
    $page = new Page($idPage);
	require_once(FRONT_FOLDER.'head.php');
	require_once(FRONT_FOLDER.'template/'.$page->getTemplate().'.php');
	//var_dump(Article::getAll($idPage));
}

?>
</body>
<?php
require('./view/templates/end.php');
?>
