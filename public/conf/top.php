<?php

/* Fichiers de configuration */
require_once(CMS_FOLDER.'conf/settings.php');            // Configuration de l'accès à la base de données

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
	'test' => 'test.view.php',
	'connexion' => 'connexion.view.php'
); // à mettre à jour à chaque ajout de page ou d'element à afficher si le nom est different


const TITLES = array(
	'user_add' => 'Ajouter un utilisateur',
	'picture_add' => 'Ajouter une image',
	'page_add' => 'Ajouter une page',
	'page_update' => 'Modifier une page',
	'article_add' => 'Ajouter un article',
	'article_update' => 'Modifier un article',

	'users_list' => 'Liste des utilisateurs',
	'articles_list' => 'Liste des articles',
	'pages_list' => 'Liste des pages',
	'gallery' => "Galerie d'images",
	'accueil' => 'Accueil',
	'connexion' => 'Connexion',
	'dashboard' => 'Tableau de bord',
	'config' => 'Paramètres Méta'
);



$page = (!empty($_GET['page'])) ? strtolower($_GET['page']) : 'accueil';
/**
 * @var string Nom de la page courante.
 */
define('CURRENT_PAGE', $page);

$action = (!empty($_GET['action'])) ? strtolower($_GET['action']) : '';
/**
 * @var string Nom de l'action en cours, s'il y a.
 */
define('CURRENT_ACTION', $action);

if(!empty($_SESSION['user'])){
	define('CURRENT_USER_ID', intval($_SESSION['user']));
	$CURRENT_USER = new User(intval($_SESSION['user']));
}
