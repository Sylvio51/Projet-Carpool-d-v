<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/include/connect.php';

$ville_depart = isset($_GET['ville_depart']) ? $_GET['ville_depart'] : '';
$ville_arrivee = isset($_GET['ville_arrivee']) ? $_GET['ville_arrivee'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

$date = "2023-06-15 10:30:00";
$ville_depart = "Reims";
$ville_arrivee = 1;

$sql = "SELECT *
FROM annonce
WHERE Depart = :ville_depart
  AND Destination = :ville_arrivee
  AND Date_depart >= :date_depart";

echo $sql;

$stmt = $db->prepare($sql);
$stmt->bindParam(':ville_depart', $ville_depart);
$stmt->bindParam(':ville_arrivee', $ville_arrivee);
$stmt->bindParam(':date_depart', $date);

if ($ville_arrivee == 1){
    $ville_arrivee = "MNS";
}else{
    $ville_arrivee = "IFA";
}

$stmt->execute();
$annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/admin/CSS/style_form.css">
    <link rel="stylesheet" href="/admin/CSS/style_index_reservation.css">
    <title>Réserver</title>
</head>
<body>
<header class="header">
        <div class="logo">
            <img id="logoCarpoolHeader" src="/images/logoCarpool.png" alt="">
        </div>
        <div class="loginHeader">
            <div class="whiteCercle">
                <img id="logoLogin" src="/images/login.png" alt="">
            </div>
            <p>Connexion</p>
        </div>
    </header>
    <div class="container">
        <?php
            if (count($annonces) > 0) {
                foreach ($annonces as $annonce) {
                    // Générer le HTML pour afficher les détails de l'annonce
                    echo "<div class='annonce'>";
                    echo "<h3>De " . $annonce['Depart'] . " à " . $annonce['Destination'] . "</h3>";
                    echo "<p>Date de départ : " . $annonce['Date_depart'] . "</p>";
                    // Ajouter d'autres détails de l'annonce ici (prix, nombre de places, etc.)
                    echo "</div>";
                }
            } else {
                echo "<p>Aucune annonce trouvée pour ces critères de recherche.</p>";
            }
        ?>
    </div>
    <footer class="footer">
        <div class="logo">
            <img id="logoCarpoolFooter" src="/images/logoCarpool.png" alt="">
        </div>
    </footer>
</body>
</html>