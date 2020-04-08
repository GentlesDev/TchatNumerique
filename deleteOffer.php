<?php
session_start();
include "classes/Database.class.php";
include "classes/Offer.class.php";

if ($_SESSION['role'] !== 'admin') {
    Header('Location: index.php');
    exit();
}else{
    $offer = new Offer();
    $offer->deleteOffer($_GET['id']);
}


?>