<?php

if(!empty($_POST['user_add']) && $CURRENT_USER->isAdmin()) {

    $nickname = strval($_POST['nickname']);
    $firstname = strval($_POST['firstname']);
    $lastname = strval($_POST['lastname']);
    $email = strval($_POST['email']);
    $password = strval($_POST['password']);

    if(isset($_POST['writer'])){
        $writer = $_POST['writer'];
    }else{
        $writer = 0;
    }

    if(isset($_POST['publisher'])){
        $publisher = $_POST['publisher'];
    }else{
        $publisher = 0;
    }

    if(isset($_POST['admin'])){
        $admin = $_POST['admin'];
    }else{
        $admin = 0;
    }

    $user = new User();
    $user->setNickname($nickname);
    $user->setFirstname($firstname);
    $user->setLastname($lastname);
    $user->setEmail($email);
    $user->setWriter($writer);
    $user->setPublisher($publisher);
    $user->setAdmin($admin);
    $user->setPassword($password);

    $res = $user->insertIntoDatabase();
}

if($CURRENT_USER->isAdmin()){
    include view('user_form');
}else{
    echo "Vous n'avez pas les droits pour créer un utilisateur.";
}
