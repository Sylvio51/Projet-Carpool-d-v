<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/profil.css">
    <title>Profil</title>
    <link rel="stylesheet" href="/admin/CSS/style_form.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="/admin/index.php"> <img id="logoCarpoolHeader" src="/images/logoCarpool.png" alt=""> </a>
        </div>
        <div class="loginHeader">
            <div class="whiteCercle">
                <a href="/admin/profil.php"> <img id="logoLogin" src="/images/login.png" alt=""> </a>
            </div>
            <p>Connexion</p>
        </div>
    </header>
    <div class="container">
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
    </div>
    <footer class="footer">
    <div class="logo">
        <img id="logoCarpoolFooter" src="/images/logoCarpool.png" alt="">
    </div>
</footer>
</body>
</html>