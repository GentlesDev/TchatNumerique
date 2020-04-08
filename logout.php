<?php
include 'classes/Database.class.php';
include 'classes/User.class.php';

    session_start();
    session_destroy();

$database = new Database();
$database->executeSql(
    'UPDATE
                users
                SET Status = "hors ligne"
                WHERE Pseudo = ?',
    [$_SESSION['pseudo']]
);

    Header('Location: login.php');
    exit();
?>