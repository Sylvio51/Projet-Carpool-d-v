<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carpool";

try {
$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req = $db->prepare("INSERT INTO annonce(Nom, Prenom, Mail, tel_, Adresse, Id_promo, Nombre_places, Date_depart, heure, infos_sup) VALUES(u.Nom, u.Prenom, u.Mail, :tel_, u.Adresse, u.Id_promo, :Nombre_places, :Date_depart, :heure, :infos_sup)");
$req->bindParam(':Nom', $_POST["Nom"]);
$req->bindParam(':Prenom', $_POST["Prenom"]);
$req->bindParam(':Mail', $_POST["email"]);
$req->bindParam(':tel_', $_POST["Num_tel"]);
$req->bindParam(':Adresse', $_POST["Adresse"]);
$req->bindParam(':Id_promo', $_POST["promo"]);
$req->bindParam(':Nombre_places', $_POST["Nombre_places"]);
$req->bindParam(':Date_depart', $_POST["date"]);
$req->bindParam(':heure', $_POST["heure"]);
$req->bindParam(':infos_sup', $_POST["infos_sup"]);
$req->execute();

$id = $db->lastInsertId();

header("location: ../annonce/index.php?annonce_id=$id");
}catch(PDOException $e) {
    echo "error : ". $e->getMessage();
}

$db = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>