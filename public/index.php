<?php
session_start();
require_once('./conf/top.php');
require(PATH_VIEW.'templates/head.php');

if ( !empty($CURRENT_USER) && CURRENT_PAGE !== 'accueil' && CURRENT_PAGE !== 'connexion' ) {
	require(PATH_VIEW.'templates/header.view.php');
}


include_once controller('logout'); // ça redirige vers l'accueil si on se deconnecte


?>
<body>
<?php

if ( CURRENT_PAGE !== 'accueil' ) {
	if ( CURRENT_PAGE == 'connexion' || !empty($CURRENT_USER) ) {
		require_once controller(CURRENT_PAGE);
	}else{ //si pas connecté et demande autre chose que la page de login
        goToPage('accueil');
    }
}
elseif ( empty($CURRENT_USER) ) { // on checke si $CURRENT_USER existe (c'est le cas si l'utilisateur est connecté)
	//require('./view/templates/header.view.php');
	require view('connexion'); // renommer le fichier en .view.php et cette ligne est à remplacer par : require view('connexion');
}

?>
</body>
<?php
require('./view/templates/end.php');
?>
