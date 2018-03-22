<?php

// Variables de connexion à la base de données
define('DB_HOST', 'localhost');	// Le serveur MySQL de votre BDD : à modifier
define('DB_NAME', 'BoCaCoP');		// Votre base de données : à modifier
define('DB_USER', 'root');		// Votre login : à modifier
define('DB_PWD', '');			// Votre mot de passe : à modifier

// Liens URL (inutile pour le moment)
define('URL_ROOT', 'localhost/projetCMS/');			// Path de la racine
define('URL_PATH', URL_ROOT.'public/');		// Path de l'application publique


// Liens relatifs à public/index.php
define('REL_ROOT', './');			    // lien de base dans lequel il y a l'index
define('REL_IMG', './img/');			// lien relatif des img
define('REL_LIBS', './lib/');			// lien relatif des librairies php
define('REL_MODEL', './model/');		// lien relatif des modeles
define('REL_VIEWS', './view/');			// lien relatif des vues
define('REL_CTRLS', './controller/');	// lien relatif des controleurs

?>
