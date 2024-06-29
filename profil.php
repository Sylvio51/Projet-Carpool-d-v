<?php 
// $connexion = new PDO('mysql:host=localhost;dbname=carpool', 'root', '');

// if(isset($_GET['id']) AND $_GET['id'] > 0){
//     $takeid = intval($_GET['id']);
//     $req = $connexion->prepare('SELECT * FROM utilisateurs WHERE id = ?');

//     $req->execute(array($takeid));

//     $takeinfo = $req->fetch();
// }

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
            <img src="logo.png" alt="Logo" class="logo">
            <div class="profile-icon">
                <img src="profile-icon.png" alt="Profile Icon">
            </div>
        </header>
        <main>
            <div class="profile-picture">
                <img src="profile-placeholder.png" alt="Profile Picture">
            </div>
            <h1><?=$takeinfo['Nom']?> <?=$takeinfo['Prenom']?></h1>
            <p class="promo">Promo : <?=$takeinfo['Id_promo']?></p>
            <p class="adresse"></p>
            <div class="contact">
                <p>E-mail : <?=$_SESSION['Mail']?></p>
                <p>Tel.: <?=$_SESSION['tel_']?></p>
            </div>
            <button class="modify-profile">Modifier le profil</button>
        </main>
        <footer>
            <img src="/imgs/logo carpool" alt="Footer" class="footer-logo">
            <br>
        </footer>
        <a href="">Se déconnecter</a>
    </div>
</body>
</html>