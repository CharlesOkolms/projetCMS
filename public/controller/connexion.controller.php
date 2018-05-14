<?php



    $user = new User();

    $verif;
    $email      = $_POST['email'];
    $password   = $_POST['password'];


    $verif = $user->login($email, $password);

    if($verif == true)
        goToPage('dashboard');
    else
        goToPage('accueil');


?>