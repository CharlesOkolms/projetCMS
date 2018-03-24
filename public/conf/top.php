<?php

/* Fichiers de configuration */
require_once('./conf/settings.php');            // Configuration de l'accès à la base de données

/* Librairies */
require_once(PATH_LIB . 'database.lib.php');    // Classe de la base de données
require_once(PATH_LIB . 'functions.lib.php');    // fonctions generiques

/* Modeles */
foreach ( glob(PATH_MODEL . "*.php") as $filename ) {
	require_once($filename);
	// echo '<br>'.$filename;
}

/* chemin par defaut */
// pour chaque page, indique la suivante
const NEXTPAGE = array();
?>
