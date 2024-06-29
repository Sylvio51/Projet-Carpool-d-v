<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=carpool', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}

$Nom = "";
$Prenom = "";
$Mail = "";
$Tel = "";
$Promo = "";
$Adresse = "";

$NombresPlaces = "";
$DateDepart = "";
$Destination = "";
$Depart = "";
$Heure = "";
$InfoSup = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $Mail = $_POST["Mail"];
    $Tel = $_POST["tel_"];
    $Promo = $_POST['Id_promo'];
    $Adresse = $_POST["Adresse"];
    $NombresPlaces = $_POST["Nombre_places"];
    $DateDepart = $_POST["Date_depart"];
    $Destination = isset($_POST["Destination"]) ? $_POST["Destination"] : "";
    //$Destination = $_POST["Destination"];
    $Depart = $_POST["Depart"];
    $Heure = $_POST["heure"];
    $InfoSup = $_POST["info_sup"];

    try{
    $db = $connexion;
    $db->beginTransaction();

            $sql1 = "INSERT INTO utilisateurs (Nom, Prenom, Mail, Adresse, tel_, Id_promo)
            VALUE (:Nom, :Prenom, :Mail, :Adresse, :tel_, :Id_promo)";
            $stmt1 = $db->prepare($sql1);

            $stmt1->bindParam(':Nom', $Nom);
            $stmt1->bindParam(':Prenom', $Prenom);
            $stmt1->bindParam(':Mail', $Mail);
            $stmt1->bindParam(':Adresse', $Adresse);
            $stmt1->bindParam(':tel_', $Tel);
            $stmt1->bindParam(':Id_promo', $Promo);

            $stmt1->execute();

            
            $sql2 = "INSERT INTO annonce (Nombre_places, Date_depart, Destination, Depart, heure, info_sup)
            VALUE (:Nombre_places, :Date_depart, :Destination, :Depart, :heure, :info_sup)";
            $stmt2 = $db->prepare($sql2);

            $stmt2->bindParam(':Nombre_places', $NombresPlaces);
            $stmt2->bindParam(':Date_depart', $DateDepart);
            $stmt2->bindParam(':Destination', $Destination);
            $stmt2->bindParam(':Depart', $Depart);
            $stmt2->bindParam(':heure', $Heure);
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
    if ($Promo == $row['Id']) {
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
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="CSS/publier_trajet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Publier une annonce</title>
</head>
<body>
    <header class="header">
    <nav class="navbar navbar-expand-lg">
        <img class="conn" src="/imgs/connexion.png" alt="connexion">
        <img class="trip" src="/imgs/TRIP_lutfix.png" alt="trip-lutfix">
    </nav>
    </header>
    <h1 class="d'flex justify-content-center title">Publier un trajet</h1>
    <div class="container">
        <form action="" class="form" method="POST">
        <h2>Informations sur le conducteur</h2>
        <label for="">Nom :</label>
        <br>
        <input type="text" name="Nom" id="Nom" placeholder="Nom" 
        value="<?php $Nom ?>" required>
        <br>
        <label for="">Prénom :</label>
        <br>
        <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" 
        value="<?php $Prenom ?>" required>
        <br>
        <label for="">Promo :</label>
        <br>
        <select name="Id_promo" id="Id_promo" value="<?php $Promo ?>" required>
            <?php echo $options1 ?>
        </select>
        <br>
        <label for="">E-mail :</label>
        <br>
        <input type="email" name="Mail" id="Mail" placeholder="E-mail" 
        value="<?php $Mail ?>" required>
        <br>
        <label for="">Numéro de téléphone :</label>
        <br>
        <input type="text" name="tel_" id="tel_" placeholder="Numéro de téléphone" 
        value="<?php $Tel ?>" required>

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
        <input type="number" min="2" max="10" name="Nombre_places" value="<?php $NombresPlaces ?>" required>
        <br>
        <label for="">Adresse :</label>
        <br>
        <input name="Adresse" id="Adresse" placeholder="Adresse" 
        value="<?php $Adresse ?>" required>
        <br>
        <label for="">Date & heure de trajet :</label>
        <br>
        <input class="form-control" type="date" id="Date_depart" name="Date_depart" value="<?php $DateDepart ?>" required>
        <input class="form-control" type="time" id="heure" name="heure" value="<?php $Heure ?>" required>
        <br>

        <h2>Informations supplémentaires</h2>
        <textarea name="info_sup" id="info_sup" value="<?php $InfoSup ?>"></textarea>

        <div>
        <label for="form-check-label">
        <input class="" type="checkbox" name="checkbox" id="" required>J'accepte les conditions d'utilisation de ce site
        </label>
        </div>

        <div class="button">
            <button type="button" onclick="location.href='projet-carpool-d-v/accueil.php'" class="btn btn-secondary btn-lg" id="buttonAnnuler">Annuler</button>
            <button type="submit" class="btn btn-primary btn-lg" id="buttonAccepter">Publier</button>
        </div>
        
    </form>
    </div>

    <footer>
        <div class="logo">
            <img src="/imgs/logo carpool.png" alt="logo">
        </div>
    </footer>

</body>
</html>
