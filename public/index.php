<?php
session_start();
require_once('./conf/top.php');
?>
<body>
<?php

    if(CURRENT_PAGE !== 'accueil'){
		require_once controller(CURRENT_PAGE);
    }
//    elseif(CURRENT_PAGE == 'connexion'){
    else{
        if(!defined('CURRENT_USER')){
			require('view/connexionView.php'); // renommer le fichier en .view.php et cette ligne est à remplacer par : require view('connexion');
		}
    }

?>
</body>
