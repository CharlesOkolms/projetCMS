<?php

/* Fichiers de configuration */
require_once('./conf/settings.php');		// Configuration de l'accès à la base de données

/* Librairies */
require_once(REL_LIBS.'database.lib.php');		// Classe de la base de données
require_once(REL_LIBS.'functions.lib.php');		// fonctions generiques

/* Modeles */
foreach (glob(REL_MODEL."*.php") as $filename) {
	require_once($filename);
	// echo '<br>'.$filename;
}

/* chemin par defaut */
// pour chaque page, indique la suivante
$nextpage = array();
$nextpage['accueil']='connexion';
$nextpage['connexion']='template';
$nextpage['template']='entete';
$nextpage['entete']='experience';
$nextpage['experience']='formation';
$nextpage['formation']='competence';
$nextpage['competence']='synthese';
$nextpage['synthese']='CV';
$nextpage['import']='moncompte';

?>
