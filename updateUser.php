<?php
session_start();
include 'classes/Database.class.php';
include 'classes/User.class.php';
if(array_key_exists('role',$_SESSION) === false){
    Header('Location: login.php');
    exit();
}
$log = new User;
$users = $log->getAllUsers();
if (empty($_POST) === false) {
    $log->UpdateUser($_POST);
}
$template = 'updateUser';
include 'phtml/layout.phtml';
