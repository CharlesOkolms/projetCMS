<?php
session_start();
require_once('./conf/top.php');
require('./view/templates/head.php');
if(!empty($CURRENT_USER) && CURRENT_PAGE !== 'accueil' && CURRENT_PAGE !== 'connexion'){
	require('./view/templates/header.view.php');
}

?>
<body>
<?php

    if(CURRENT_PAGE !== 'accueil'){
		require_once controller(CURRENT_PAGE);
    }
//    elseif(CURRENT_PAGE == 'connexion'){
    else{
        if(!defined('CURRENT_USER')){ // on checke si la constante "CURRENT_USER" est définie (c'est le cas si l'utilisateur est connecté)
            //require('./view/templates/header.view.php');
            require('./view/connexion.view.php'); // renommer le fichier en .view.php et cette ligne est à remplacer par : require view('connexion');
		}
    }

?>
</body>
<?php
require('./view/templates/end.php');
?>
