<?php

    $arrayAdmins = User::getAll('admin');

    if(!empty($_POST['config_add']) && $CURRENT_USER->isSuperAdmin()){
        $title = strval($_POST['title']);
        $pageAccueil = strval($_POST['pageAccueil']);

        $meta = new Meta();
        $meta->setTitle($title);
        $meta->setHomepage($pageAccueil);

		if(!empty($_POST['superAdmin'])){
			$idSuperAdmin = strval($_POST['superAdmin']);
			$meta->setSuperadmin($idSuperAdmin);
		}


		if(!empty($_FILES)) {
			$picfile = $_FILES['logo'];
			$filename = $picfile['name'];
			if ( strstr($picfile['type'], 'image') ) {
				$ok = true;
			}
			else {
				$ok = false;
			}

			if ( $ok === true ) {
				$ext = explode('.', $filename);
				$ext = end($ext);
				move_uploaded_file($picfile['tmp_name'], FRONT_FOLDER.'sitelogo.'.$ext);
				$meta->setLogo('sitelogo.'.$ext);
			}
		}
        $res = $meta->updateDatabase();
    }
    if($CURRENT_USER->isSuperAdmin()){
        $meta = new Meta();
        include view('config');
    }else{
        echo "Vous n'avez pas les droits pour accéder à la page paramètre.";
    }
