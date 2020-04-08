<?php 
session_start();
include "classes/Database.class.php";
include "classes/Offer.class.php";

if ($_SESSION['role'] !== 'admin') {
    Header('Location: index.php');
    exit();
} else {
    $offer = new Offer();
    $offre = $offer->getOneOffer($_GET['id']);
    if (empty($_POST) === false) {
        $offer->updateOffer($_POST);
    }
}

$template = "updateOffer";
include "phtml/layout.phtml";

?>