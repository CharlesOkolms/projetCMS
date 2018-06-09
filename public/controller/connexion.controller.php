<?php

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

