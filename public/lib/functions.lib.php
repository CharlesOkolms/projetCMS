<?php
// fonctions génériques en php utilisables n'importe où dans le projet

/**
 * Permet de tester une date contre un format indiqué.
 *
 * @param string $date   La date à tester
 * @param string $format Format présumé de la date à tester
 * @return bool Renvoie TRUE si $date est bien bien une date dans le format indiqué, FALSE sinon.
 */
function validateDate($date, $format = 'Y-m-d') {
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

/**
 * Génère une string random de la longueur demandée.
 *
 * @param int $l : longueur de la chaine générée.
 * @return string
 */
function randomString(int $l) {
	$c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	srand((double)microtime() * 1000000);
	$rand = '';
	for ( $i = 0; $i < $l; $i++ ) {
		$rand .= $c[rand() % strlen($c)];
	}
	return $rand;
}

/**
 * Genere une chaine de caracteres qui peut servir pour le lien URL d'un article par exemple.
 *
 * @param string $string
 * @return null|string|string[]
 */
function create_slug(string $string) {
	if ( !empty($string) ) {
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		return $slug;
	}

}


/**
 * Permet de rediriger vers une page
 *
 * @param $page
 */
function goToPage($page) {
	header('Location:./index.php?page=' . $page);
}

// si $view est à false (pas d'argument) retourne le chemin de la vue par défaut associée
// à la page courante
/**
 * @param bool $pageOrElement
 * @return string
 */
// WORK IN PROGRESS
function view($pageOrElement = false) : string {
	$page = $pageOrElement; // pour rendre la suite + lisible

	if ( $page === false ) {
		return PATH_VIEW.VIEWS[CURRENT_PAGE];
	}
	elseif ( is_string($page) ) {
		if ( in_array($page, VIEWS) ) {
			return PATH_VIEW.VIEWS[$page];
		}
		return (file_exists(PATH_VIEW.$page.'.view.php')) ? PATH_VIEW.$page.'.view.php' : PATH_VIEW.'null.php';
	}
	return PATH_VIEW.'null.php';
}

/**
 * Permet d'obtenir le chemin vers le controleur ayant le nom demandé.
 *
 * @param bool $name
 * @return string
 */
function controller($name = false) : string {
	$page = $name; // pour rendre la suite + lisible

	if ( $page === false ) {
		return PATH_CONTROLLER.CONTROLLERS[CURRENT_PAGE];
	}
	elseif ( is_string($page) ) {
		if ( in_array($page, CONTROLLERS) ) {
			return PATH_CONTROLLER.CONTROLLERS[$page];
		}
		return (file_exists(PATH_CONTROLLER.$page.'.controller.php')) ? PATH_CONTROLLER.$page.'.controller.php' : PATH_CONTROLLER.'null.php';
	}
	return PATH_CONTROLLER.'null.php';
}
