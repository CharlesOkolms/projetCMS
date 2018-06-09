<?php

if(!empty($_POST['email'])){
	$user = new User();

	$email      = $_POST['email'];
	$password   = $_POST['password'];


	$verif = $user->login($email, $password);

	if($verif === true) {
		$_SESSION['user'] = $user->getId();
		goToPage('dashboard');
	}
	else {
		echo 'ECHEC de connexion';
		require view();
		// goToPage('accueil');
	}
} else if(empty($CURRENT_USER)){ // si pas connecté
	include_once view(); // on affiche le formulaire de connexion
} else { // sinon on est deja connecté
	goToPage('dashboard');
}
