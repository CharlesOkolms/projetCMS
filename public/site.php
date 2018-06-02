<?php
session_start();
require_once('./conf/top.php');
require('./view/templates/head.php');
?>
<body>
<?php

if(CURRENT_PAGE !== 'accueil'){
	// chercher en BDD les articles liés à la page
	var_dump(Article::getAll(1));
}

?>
</body>
<?php
require('./view/templates/end.php');
?>
