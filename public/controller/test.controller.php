<?php
$user = new User(1);
$article = new Article(1);
$users = User::getAll('admin');
include view();
