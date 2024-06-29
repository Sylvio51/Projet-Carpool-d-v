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
    <title>Profil</title>
</head>
<body>
    <h1> <?=$takeinfo['Nom']?> </h1>
    <h1> <?=$takeinfo['Prenom']?> </h1>
    <h1> <?=$takeinfo['Mail']?> </h1>
    <h1> <?=$takeinfo['Photo_profil']?> </h1>
    <h1> <?=$takeinfo['tel_']?> </h1>
    <h1> <?=$takeinfo['Id_promo']?> </h1>





<a href="">Se déconnecter</a>
</body>
</html>