<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=carpool', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}

$Nom_utilisateur = "";
$Prenom_utilisateur = "";
$Mail_utilisateur = "";
$Tel_utilisateur = "";
$Id_promo_utilisateur = "";
$Adresse_utilisateur = "";

$Nombre_places = "";
$Date_Depart = "";
$Destination = "";
$Depart = "";
$InfoSup = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nom_utilisateur = $_POST['Nom_utilisateur'];
    $Prenom_utilisateur = $_POST['Prenom_utilisateur'];
    $Mail_utilisateur = $_POST["Mail_utilisateur"];
    $Tel_utilisateur = $_POST["tel_utilisateur"];
    $Id_promo_utilisateur = $_POST['Id_promo_utilisateur'];
    $Adresse_utilisateur = $_POST["Adresse"];
    $Nombre_places = $_POST["Nombre_places"];
    $Date_Depart = $_POST["Date_Depart"];
    $Destination = isset($_POST["Destination"]) ? $_POST["Destination"] : "";
    //$Destination = $_POST["Destination"];
    $Depart = $_POST["Depart"];
    $InfoSup = $_POST["info_sup"];

    try{
    $db = $connexion;
    $db->beginTransaction();

            $sql1 = "INSERT INTO utilisateurs (Nom_utilisateur, Prenom_utilisateur, Mail_utilisateur, Adresse_utilisateur, tel_utilisateur, Id_promo_utilisateur)
            VALUE (:Nom_utilisateur, :Prenom_utilisateur, :Mail_utilisateur, :Adresse_utilisateur, :tel_utilisateur, :Id_promo_utilisateur)";
            $stmt1 = $db->prepare($sql1);

            $stmt1->bindParam(':Nom_utilisateur', $Nom_utilisateur);
            $stmt1->bindParam(':Prenom_utilisateur', $Prenom_utilisateur);
            $stmt1->bindParam(':Mail_utilisateur', $Mail_utilisateur);
            $stmt1->bindParam(':Adresse_utilisateur', $Adresse_utilisateur);
            $stmt1->bindParam(':tel_utilisateur', $Tel_utilisateur);
            $stmt1->bindParam(':Id_promo_utilisateur', $Id_promo_utilisateur);

            $stmt1->execute();

            
            $sql2 = "INSERT INTO annonce (Nombre_places, Date_Depart, Destination, Depart, info_sup)
            VALUE (:Nombre_places, :Date_Depart, :Destination, :Depart, :info_sup)";
            $stmt2 = $db->prepare($sql2);

            $stmt2->bindParam(':Nombre_places', $Nombre_places);
            $stmt2->bindParam(':Date_Depart', $Date_Depart);
            $stmt2->bindParam(':Destination', $Destination);
            $stmt2->bindParam(':Depart', $Depart);
            $stmt2->bindParam(':info_sup', $InfoSup);

            $stmt2->execute();

            $db->commit();
            echo "Annonce ajoutée avec succès";
    } catch (PDOException $e) {
        $db->rollBack();
        echo "Erreur : ". $e->getMessage();
    }
        
}


$sql3 = "SELECT * FROM promo";
$stmt3 = $connexion->query($sql3); 

$options1 = "<option value='' disabled selected>Sélectionnez votre promo</option>"; 

while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
    $options1 .= "<option value='" . $row["Id"] . "'";
    if ($Id_promo_utilisateur == $row['Id']) {
        $options1 .= " selected"; 
    }
    $options1 .= ">" . $row["Nom"] . "</option>";
}


$sql4 = "SELECT * FROM destination";
$stmt4 = $connexion->query($sql4); 

$options2 = "<option value='' disabled selected>Destination</option>"; 

while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
    $options2 .= "<option value='" . $row["Id"] . "'";
    if ($Destination == $row['Id']) {
        $options2 .= " selected"; 
    }
    $options2 .= ">" . $row["Nom"] . "</option>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/publier-trajet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/admin/CSS/style_form.css">
    <title>Publier une annonce</title>
</head>
<body>
<header class="header">
        <div class="logo">
            <a href="/accueil.php"> <img id="logoCarpoolHeader" src="/images/logoCarpool.png" alt=""> </a>
        </div>
        <div class="loginHeader">
            <div class="whiteCercle">
                <a href="/connexion.php"> <img id="logoLogin" src="/images/login.png" alt=""> </a>
            </div>
            <p>Connexion</p>
        </div>
    </header>
    <center>
    <h1 class="d'flex justify-content-center title">Publier un trajet</h1>
    </center>
    <div class="container">
        <form action="" class="form" method="POST">
        <h2>Informations sur le conducteur</h2>
        <label for="">Nom :</label>
        <br>
        <input type="text" name="Nom_utilisateur" id="Nom_utilisateur" placeholder="Nom" 
        value="<?php $Nom_utilisateur ?>" required>
        <br>
        <label for="">Prénom :</label>
        <br>
        <input type="text" name="Prenom_utilisateur" id="Prenom_utilisateur" placeholder="Prenom" 
        value="<?php $Prenom_utilisateur ?>" required>
        <br>
        <label for="">Promo :</label>
        <br>
        <select name="Id_promo_utilisateur" id="Id_promo_utilisateur" value="<?php $Id_promo_utilisateur ?>" required>
            <?php echo $options1 ?>
        </select>
        <br>
        <label for="">E-mail :</label>
        <br>
        <input type="email" name="Mail_utilisateur" id="Mail_utilisateur" placeholder="E-mail" 
        value="<?php $Mail_utilisateur ?>" required>
        <br>
        <label for="">Numéro de téléphone :</label>
        <br>
        <input type="text" name="tel_utilisateur" id="tel_utilisateur" placeholder="Numéro de téléphone" 
        value="<?php $Tel_utilisateur ?>" required>

        <h2>Détails du trajet</h2>
        <label for="">Ville de départ :</label>
        <br>
        <input type="text" name="Depart" id="Depart" placeholder="Ville de départ" value="<?php $Depart ?>" required>
        <br>
        <label for="">Destination :</label>
        <br>
        <select name="Destination" id="Destination" placeholder="Destination" value="<?php $Destination ?>" required>
            <?php echo $options2 ?>
        </select>        
        <br>
        <label for="">Nombres de places :</label>
        <br>
        <input type="number" min="2" max="10" name="Nombre_places" value="<?php $Nombre_places ?>" required>
        <br>
        <label for="">Adresse :</label>
        <br>
        <input name="Adresse_utilisateur" id="Adresse_utilisateur" placeholder="Adresse" 
        value="<?php $Adresse_utilisateur ?>" required>
        <br>
        <label for="">Date & heure de trajet :</label>
        <br>
        <input class="form-control" type="date" id="Date_Depart" name="Date_Depart" value="<?php $Date_Depart ?>" required>
        <input class="form-control" type="time" id="Date_Depart" name="Date_Depart" value="<?php $Date_Depart ?>" required>
        <br>

        <h2>Informations supplémentaires</h2>
        <textarea name="info_sup" id="info_sup" value="<?php $InfoSup ?>"></textarea>

        <div>
        <label for="form-check-label">
        <input class="" type="checkbox" name="checkbox" id="" required>J'accepte les conditions d'utilisation de ce site
        </label>
        </div>

        <div class="button">
            <button type="button" onclick="location.href='accueil.php'" class="btn btn-secondary btn-lg" id="buttonAnnuler">Annuler</button>
            <button type="submit" class="btn btn-primary btn-lg" id="buttonAccepter">Publier</button>
        </div>
        
    </form>
    </div>
    </div>
    <footer class="footer">
        <div class="logo">
            <img id="logoCarpoolFooter" src="/images/logoCarpool.png" alt="">
        </div>
    </footer>
</body>
</html>
