<?php 
// $Id_utilisateur = "";
// $Nom = "";
// $Prenom = "";
// $Email = "";
// $Telephone = "";
// $Adresse = "";
// $Promo = "";
// $NombresDePlaces = "";
// $Date = "";
// $Heure = "";
// $infosup = "";

// $sql = "SELECT * FROM annonce";
// $result = $db->query($sql); // Exécution de la requête SQL

// $options = "<option value='' disabled selected>Promo</option>"

// while($row = $result->fetch(PDO::FETCH_ASSOC)) {
//     $options .= "<option value='" . $row["Id"] . "'";
//     if($Id_Promo == $row["Id"]) {
//         $options.= "selected"; // Sélectionner l'option
//     }
//     $options .= ">" . $row["Nom"] . "</option>";
// }

// if ($row) {
//     $Id_utilisateur = $row["Id_utilisateur"];
//     $Nom_utilisateur = $row['Nom'];
//     $Prenom_utilisateur = $row['Prenom'];
//     $Mail_utilisateur = $row["Mail"];
//     $Tel_utilisateur = $row["Tel"];
//     $Id_promo_utilisateur = $row['Promo'];
//     $Adresse_utilisateur = $row["Adresse"];
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/style_index.css">
    <link rel="stylesheet" href="/CSS/reset.css">
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
        <img class="connexion" src="imgs/connexion.png" alt="connexion">
        <img class="trip" src="imgs/TRIP_lutfix.png" alt="trip-lutfix">
    </nav>
    </header>
    <h1 class="d'flex justify-content-center title">Publier un trajet</h1>
    <div class="container">
        <form action="annonce/process.php" class="form" method="POST">
        <h2>Informations sur le conducteur</h2>
        <label for="">Nom :</label>
        <br>
        <input type="text" name="Nom" id="Nom" placeholder="Nom" 
        value="" required>
        <br>
        <label for="">Prénom :</label>
        <br>
        <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" 
        value="" required>
        <br>
        <label for="">Promo :</label>
        <br>
        <select name="promo" id="" value="" required>
            <option value="" selected disabled hidden>Promo</option>
            <option value="BSD">BSD</option>
            <option value="BSRC">BSRC</option>
            <option value="DEVWEB">DEVWEB</option>
            <option value="TSSR">TSSR</option>
        </select>
        <br>
        <label for="">E-mail :</label>
        <br>
        <input type="text" name="email" id="email" placeholder="E-mail" 
        value="" required>
        <br>
        <label for="">Numéro de téléphone :</label>
        <br>
        <input type="text" name="Num_tel" id="Num_tel" placeholder="Numéro de téléphone" 
        value="" required>

        <h2>Détails du trajet</h2>
        <label for="">Nombres de places :</label>
        <br>
        <input type="number" min="2" max="10" name="Nombre_places" required>
        <br>
        <label for="">Adresse :</label>
        <br>
        <input name="Adresse" id="Adresse" placeholder="Adresse" 
        value="" required>
        <br>
        <label for="">Date & heure de trajet :</label>
        <br>
        <input class="form-control" type="date" id="date" name="date" required>
        <input class="form-control" type="time" id="time" name="time" required>
        <br>

        <h2>Informations supplémentaires</h2>
        <textarea name="infos_sup" id=""></textarea>

        <div>
        <label for="form-check-label">
        <input class="" type="checkbox" name="checkbox" id="" required>J'accepte les conditions d'utilisation de ce site
        </label>
        </div>

        <div class="button">
            <button type="button" class="btn btn-secondary btn-lg" id="buttonAnnuler">Annuler</button>
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
