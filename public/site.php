<?php
session_start();
require_once('./conf/top.php');
require('./view/templates/head.php');
?>
<body>
<?php

if(CURRENT_PAGE !== 'accueil'){
	// chercher en BDD les articles liés à la page
    $idPage = Page::findPageId(CURRENT_PAGE);
	var_dump(Article::getAll($idPage));
}

?>
</body>
<?php
require('./view/templates/end.php');
?>
