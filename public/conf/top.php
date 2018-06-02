<?php

/* Fichiers de configuration */
require_once('./conf/settings.php');            // Configuration de l'accès à la base de données

/* Librairies */
require_once(PATH_LIB.'database.lib.php');    // Classe de la base de données
require_once(PATH_LIB.'functions.lib.php');    // fonctions generiques

/* Modeles */
foreach ( glob(PATH_MODEL."*.php") as $filename ) {
	require_once($filename);
}

	/**
	 * @var array Tableau associatif contenant la liste des noms de fichiers des controleurs.
	 */
const CONTROLLERS = array(
	'test' => 'test.controller.php'
); // à mettre à jour à chaque ajout de page

	/**
	 * @var array Tableau associatif contenant la liste des noms de fichiers des vues.
	 */
const VIEWS = array(
	'test' => 'test.view.php'
); // à mettre à jour à chaque ajout de page ou d'element à afficher

$page = (!empty($_GET['page'])) ? strtolower($_GET['page']) : 'accueil';

	/**
	 * @var string Nom de la page courante.
	 */
define('CURRENT_PAGE', $page);

if(!empty($_SESSION['user'])){
	define('CURRENT_USER_ID', intval($_SESSION['user']));
	$CURRENT_USER = new User(intval($_SESSION['user']));
}
