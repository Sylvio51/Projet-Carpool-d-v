<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=carpool', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/include/protect.php';

$ville_depart = isset($_GET['ville_depart']) ? $_GET['ville_depart'] : '';
$ville_arrivee = isset($_GET['ville_arrivee']) ? $_GET['ville_arrivee'] : 0;
$date = isset($_GET['date']) ? $_GET['date'] : '';


if ($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['ville_depart']) || isset($_GET['ville_arrivee']) || isset($_GET['date']) || isset($_GET['heure']))) {
    if ($ville_depart && $ville_arrivee && $date && $time) {
        
        header("Location: /admin/reserver/index.php?ville_depart=$ville_depart&ville_arrivee=$ville_arrivee&date=$date&heure=$time");
        exit;
    }
}



$sql1 = "SELECT * FROM Destination";
$stmt1 = $connexion->query($sql1); 

$option = "<option value='' disabled selected>Destination</option>"; 

while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
    $option .= "<option value='" . $row["Id"] . "'";
    if ($ville_arrivee == $row['Id']) {
        $option .= " selected"; 
    }
    $option .= ">" . $row["Nom"] . "</option>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/CSS/reset.css">
    <link rel="stylesheet" href="/CSS/connexion.css">
    <link rel="stylesheet" href="/CSS/accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
    <header>
    <div data-aos="fade-right">
    <nav class="navbar navbar-expand-lg">
    <a href="profil.php">
        <img class="connexion" src="/imgs/connexion.png" alt="connexion">
    </a>
        <img class="trip" src="/imgs/TRIP_lutfix.png" alt="trip-lutfix">
    </div>
    </nav>
    </header>
    <div data-aos="fade-right">
    <img id="logo_carpool" class="logo" src="/imgs/logo carpool.png" alt="image">
    <div class="bg">
        <img id="image_background" src="/imgs/background.jpg" class="rounded mx-auto d-block" alt="fond">
    <form id="search-form" method="GET" action="/admin/reserver/index.php">
        <input class="form-control" type="text" id="ville_depart" placeholder="Ville de départ" required>
        <select class="form-select" name="Destination" id="Destination" placeholder="Destination" value="<?php $ville_arrivee ?>" required>
            <?php echo $option ?>
        </select>
        <input class="form-control" type="date" id="date" name="date" required>
        <input class="form-control" type="time" id="time" name="heure" required>
        <button class="recherche" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Rechercher</button>
    </form>
    </div>
    </div>
    <div data-aos="fade-right">
    <div class="img-container">
        <div class="white-overlay"></div>
        <p>Découvrez notre plateforme de covoiturage dédiée à Metz Numeric School ! Simplifiez vos trajets quotidiens vers l'école en les partageant avec d'autres étudiants. Économique, convivial et écologique, notre service facilite vos déplacements pour une expérience scolaire plus pratique.</p>
</div>
</div>
<div data-aos="fade-right">
    <section id="publier_annonce">
        <div class="background-blue">
            <button onclick="location.href='annonce/form.php'" type="button" class="btn btn-primary"><i class="fa-solid fa-car"></i> Publier un trajet</button>
            <p>Vous avez une voiture ?</p>
            <img class="route" src="/imgs/route.png" alt="route">
            <img class="batiment" src="/imgs/batiment.png" alt="batiment">
            <img class="mns-logo" src="/imgs/MNSlogo.png" alt="mns-logo">
            <img class="voiture" src="/imgs/voiture.png" alt="voiture">
    </div>
    </section>
    <!-- <div data-aos="fade-right">
    <section id="avis">
        <div class="background-green">
        <div>
            <p>Notez vos covoiturages</p>
            <button type="button" class="btn btn-info"><i class="fas fa-comment"></i> Donnez votre avis</button>
        </div>
        <div>
            <img class="phonecar" src="imgs/phonecar.png" alt="telephone">
        </div>
        <div>
        <img class="etoiles" src="imgs/etoiles.png" alt="etoiles">
    </div>
    </section>
</div>
<div data-aos="fade-right"> -->
    <footer class="footer">
        <div class="logoFooter">
            <img id="logoCarpoolFooter" src="/imgs/logo carpool.png" alt="">
        </div>
    </footer>
</div>
</div>
<script>
AOS.init();
</script>
<script src="JS/script-index.js"></script>
</body>
</html>