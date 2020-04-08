<?php
ini_set('default_charset', 'UTF8');
session_start();
include 'classes/Database.class.php';
include 'classes/User.class.php';
include 'classes/Post.class.php';

$error = null;

if (empty($_POST) === false) {

    $post = new Post();

    $post->sendMsg($_POST);

    return $error;
}

    $template = 'index';


    include 'phtml/layout.phtml';
?>