<?php 
$connexion = new PDO('mysql:host=localhost;dbname=carpool', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0){
    $takeid = intval($_GET['id']);
    $req = $connexion->prepare('SELECT * FROM utilisateurs WHERE id = ?');

    $req->execute(array($takeid));

    $takeinfo = $req->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/profil.css">
    <title>Profil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <a href="accueil.php">
        <img src="imgs/logo carpool" alt="" class="carpool-logo">
        </a>
        </header>
        <main>
            <div class="photo-profil">
                <img src="<?=$_SERVER["Photo_profil_utilisateur"] ?>" alt="">
            </div>
            <h1><?=$_SERVER['Nom_utilisateur']?> <?=$_SERVER['Prenom_utilisateur']?></h1>
            <p class="promo">Promo : <?=$_SERVER['Id_promo_utilisateur']?></p>
            <p class="adresse"></p>
            <div class="contact">
                <p>E-mail : <?=$_SERVER['Mail_utilisateur']?></p>
                <p>Tel.: <?=$_SERVER['tel_utilisateur']?></p>
            </div>
        </main>
        <footer>
            <img src="imgs/logo carpool" alt="Footer" class="footer-logo">
        </footer>
    </div>
</body>
</html>