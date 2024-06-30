<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/profil.css">
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
                <img src="<?=$_SESSION["Photo_profil"] ?>" alt="">
            </div>
            <h1><?=$_SESSION['Nom']?> <?=$_SESSION['Prenom']?></h1>
            <p class="promo">Promo : <?=$_SESSION['Id_promo']?></p>
            <p class="adresse"></p>
            <div class="contact">
                <p>E-mail : <?=$_SESSION['Mail']?></p>
                <p>Tel.: <?=$_SESSION['tel']?></p>
            </div>
        </main>
        <footer>
            <img src="imgs/logo carpool" alt="Footer" class="footer-logo">
        </footer>
    </div>
</body>
</html>