<?php
ini_set('default_charset', 'utf-8');
// 2 hours in seconds
ini_set('session.gc_maxlifetime', 5); // set the session max lifetime to 2 hours

    session_start();
    include 'classes/Database.class.php';
    include 'classes/User.class.php';
    include 'classes/Post.class.php';
    $log = new User;
    $post = new Post;
    $users = $log->getAllUsers();
    $messages = $post->getAllMessages();
    

    
    $template = 'index';
    include 'phtml/layout.phtml';
?>