<?php

$list_users = User::getAll();
$arrayAdmins = User::getAll('admin');

include view('dashboard');
