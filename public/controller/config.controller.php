<?php

    $arrayAdmins = User::getAll('admin');

    if(!empty($_POST['config_add']) && $CURRENT_USER->isSuperAdmin()){
        $title = strval($_POST['title']);
        $nomSuperAdmin = strval($_POST['nomSuperAdmin']);
        $pageAccueil = strval($_POST['pageAccueil']);

        $meta = new Meta();
        $meta->setTitle($title);
        $meta->setSuperadmin($nomSuperAdmin);
        $meta->setHomepage($pageAccueil);
        $res = $meta->updateDatabase();
    }
    if($CURRENT_USER->isAdmin()){
        $meta = new Meta();
        include view('config');
    }else{
        echo "Vous n'avez pas les droits pour accéder à la page paramètre.";
    }


