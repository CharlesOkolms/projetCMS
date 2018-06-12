<?php

if(!empty($_POST['user_update'])) {

    $nickname = strval($_POST['nickname']);
    $firstname = strval($_POST['firstname']);
    $lastname = strval($_POST['lastname']);
    $email = strval($_POST['email']);
    $password = strval($_POST['password']);


    $user = new User(CURRENT_USER_ID);
    $user->setNickname($nickname);
    $user->setFirstname($firstname);
    $user->setLastname($lastname);
    $user->setEmail($email);
    $user->setPassword($password);

    $res = $user->updateDatabasePerso();
}


$user = new User(CURRENT_USER_ID);
include view('user_update');


