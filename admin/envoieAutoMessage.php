<?php

$emailAnnonceur = isset($_POST['Mail_utilisateur']) ? $_POST['Mail_utilisateur'] : '';

if (!empty($emailAnnonceur)) {
    $to = $emailAnnonceur;
    $subject = "Une nouvelle réservation a été effectuée";
    $message = "Vous avez une nouvelle réservation pour votre annonce du" . $date;
    $headers = "From: carpoolMNS@gmail.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "Email envoyé";
    } else {
        echo "Email non envoyé";
    }
} else {
    echo "Aucun email d'annonceur fourni";
}