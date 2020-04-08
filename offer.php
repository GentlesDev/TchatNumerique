<?php
    session_start();
    include "classes/Database.class.php";
    include "classes/Offer.class.php";

    $offer = new Offer();
    
    $offres = $offer->getAllOffers();
    if(empty($_POST) === false){
        $offres = $offer->getAllOffers();
        $offer->AddOffer($_POST);
    }

    $template = 'offer';
    include "phtml/layout.phtml";

?>