<?php 
$Id_utilisateur = "";
$Nom = "";
$Prenom = "";
$Email = "";
$Telephone = "";
$Adresse = "";
$Id_Promo = "";

$sql = "SELECT * FROM annonce";
$result = $db->query($sql); // Exécution de la requête SQL

$options = "<option value='' disabled selected>Promo</option>"

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $options .= "<option value='" . $row["Id"] . "'";
    if($Id_Promo == $row["Id"]) {
        $options.= "selected"; // Sélectionner l'option
    }
    $options .= ">" . $row["Nom"] . "</option>";
}

if ($row) {
    $Id_utilisateur = $row["Id_utilisateur"];
    $Nom_utilisateur = $row['Nom'];
    $Prenom_utilisateur = $row['Prenom'];
    $Mail_utilisateur = $row["Mail"];
    $Tel_utilisateur = $row["Tel"];
    $Id_promo_utilisateur = $row['Promo'];
    $Adresse_utilisateur = $row["Adresse"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/CSS/style-index.css">
    <title>Publier une annonce</title>
</head>
<body>
    <header class="header">
    <nav class="navbar navbar-expand-lg">
        <img class="connexion" src="imgs/connexion.png" alt="connexion">
        <img class="trip" src="imgs/TRIP_lutfix.png" alt="trip-lutfix">
    </nav>
    </header>
    <h1 class="d'flex justify-content-center title">Publier un trajet</h1>
    <div class="container">
        <form action="" class="form" method="POST">
        <h2>Informations sur le conducteur</h2>
        <label for="">Nom :</label>
        <input type="text" name="Nom" id="Nom" placeholder="Nom" 
        value="<?= $Nom ?>">
        <label for="">Prénom :</label>
        <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" 
        value="<?= $Prenom ?>">
        <label for="">Promo :</label>
        <select name="form-select" id="" value="<?= $Id_promo ?>">
        <?php echo $options; ?>
        </select>
        <label for="">E-mail :</label>
        <input type="text" name="email" id="email" placeholder="email" 
        value="<?= $Email ?>">>
        <label for="">Numéro de téléphone :</label>
        <input type="text" name="Num_tel" id="Num_tel" placeholder="Numéro de téléphone" 
        value="<?= $Numero_tel ?>">>

        <h2>Détails du trajet</h2>
        <label for="">Adresse :</label>
        <input name="Adresse" id="Adresse" placeholder="Adresse" 
        value="<?= $Adresse ?>">
        <label for="">Date & heure de trajet :</label>
        <input type="text" name="Date_heure" id="Date_heure" placeholder="Date & heure" 
        value="<?= $Date_heure ?>">
        <label for="">Fréquence du trajet :</label>
        <select name="form-select" id="">
            <?php echo $options; ?>
        </select>

        <h2>Informations supplémentaires</h2>
        <textarea name="infos_sup" id=""></textarea>

        <div>
        <label for="form-check-label">
        <input class="" type="checkbox" name="checkbox" id="" required>J'accepte les conditions d'utilisation de ce site
        </label>
        </div>

        <div class="button">
            <button type="button" class="btn btn-primary btn-lg" id="buttonAnnuler">Annuler</button>
            <button type="button" class="btn btn-primary btn-lg" id="buttonAccepter">Publier</button>
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
