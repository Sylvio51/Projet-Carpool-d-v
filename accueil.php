<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/connexion.css">
    <link rel="stylesheet" href="CSS/accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
    <center>
    <div id="popup-overlay">
        <div class="popup-content">
            <a href="javascript:void(0)" onclick="togglePopup()" class="popup-exit">Fermer</a>
            <br>
            <img src="imgs/connexion2.png" alt="">
            <h2>Connexion</h2>
            <form action="">
            <input type="text" name="mail" placeholder="Email">
            <br>
            <input type="text" name="mdp" placeholder="Mot de passe">
            <br>
            <a href="/" class="popup-link">Se connecter</a>
            <br>
            <a href="/" class="inscription">Vous n'avez pas de compte ?</a>
        </form>
        </div>
    </div>
</center>
    <header>
    <div data-aos="fade-right">
    <nav class="navbar navbar-expand-lg">

    
        <img onclick="togglePopup()" class="connexion" src="imgs/connexion.png" alt="connexion">
        <img class="trip" src="imgs/TRIP_lutfix.png" alt="trip-lutfix">
    </nav>
    </header>
    <div data-aos="fade-right">
    <img id="logo_carpool" class="logo" src="imgs/logo carpool.png" alt="image">
    <div class="bg">
        <img id="image_background" src="imgs/background.jpg" class="rounded mx-auto d-block" alt="fond">
    <form id="search-form">
        <input class="form-control" type="text" id="input" placeholder="Ville de départ" required>
        <select class="form-select" name="destination" id="destination" required>
            <option value="" selected disabled hidden>Destination</option>
            <option value="MNS">MNS</option>
            <option value="IFA">IFA</option>
        </select>
        <input class="form-control" type="date" id="date" name="date" required>
        <input class="form-control" type="time" id="time" name="time" required>
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
            <button type="button" class="btn btn-primary"><i class="fa-solid fa-car"></i> Publier un trajet</button>
            <p>Vous avez une voiture ?</p>
            <img class="route" src="imgs/route.png" alt="route">
            <img class="batiment" src="imgs/batiment.png" alt="batiment">
            <img class="mns-logo" src="imgs/MNSlogo.png" alt="mns-logo">
            <img class="voiture" src="imgs/voiture.png" alt="voiture">
    </div>
    </section>
    <div data-aos="fade-right">
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
<div data-aos="fade-right">
    <footer class="footer">
        <div class="logoFooter">
            <img id="logoCarpoolFooter" src="imgs/logo carpool.png" alt="">
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