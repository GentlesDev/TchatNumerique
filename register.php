<?php
    session_start();
include 'classes/Database.class.php';
include 'classes/User.class.php';

$error = null;

if(empty($_POST) === false) {
    $user = new User();

    $error = $user->addUser($_POST);

    if (array_key_exists('firstname', $_SESSION )) {
        header('Location: login.php');
        exit();
      }
}

$template = 'login';


include 'phtml/layout.phtml';
