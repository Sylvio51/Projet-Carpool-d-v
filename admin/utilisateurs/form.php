<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/include/connect.php';
$Id_utilisateur = 0;
$Nom_utilisateur = "";
$Prenom_utilisateur = "";
$Mail_utilisateur = "";
$Tel_utilisateur = "";
$Id_promo_utilisateur = "";
$Adresse_utilisateur = "";
$Mot_de_passe_utilisateur = "";
$Photo_profil_utilisateur = "";

// Choix de promo

$sql = "SELECT * FROM promo";
$result = $db->query($sql); // Exécution de la requête SQL

$options = "<option value='' disabled selected>Sélectionnez votre promo</option>"; // Placeholder option

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $options .= "<option value='" . $row["Id"] . "'";
    if ($Id_promo_utilisateur == $row['Id']) {
        $options .= " selected"; // Sélectionner l'option correspondant à l'utilisateur si nécessaire
    }
    $options .= ">" . $row["Nom"] . "</option>";
}

if (isset ($_GET['id']) && $_GET['id'] > 0) {
    $sql = 'SELECT * FROM tblclient WHERE clientId = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([":id" => $_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Récupération d'une ligne avec PDO::FETCH_ASSOC

    if ($row) {
        $Id_utilisateur = $row["Id_utilisateur"];
        $Nom_utilisateur = $row['Nom'];
        $Prenom_utilisateur = $row['Prenom'];
        $Mail_utilisateur = $row["Mail"];
        $Tel_utilisateur = $row["Tel"];
        $Id_promo_utilisateur = $row['Promo'];
        $Adresse_utilisateur = $row["Adresse"];
        $Mot_de_passe_utilisateur = $row["Mot_de_passe"];
        $Photo_profil_utilisateur = $row["Photo_Profil"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/admin/CSS/style_form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Connexion</title>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img id="logoCarpoolHeader" src="/images/logoCarpool.png" alt="">
        </div>
        <div class="loginHeader">
            <img id="logoLogin" src="/images/login.png" alt="">
        </div>
    </header>

    <div class="container">
        <h1 class="d-flex justify-content-center title">Inscription</h1>
        <form action="">
            <h2 class='title'>Information personelles</h2>
            <label for="">Nom :</label>
            <input class="form-control" type="text" placeholder="Nom" id="Nom" name="Nom" value="<?= $Nom_utilisateur ?>">
            <label for="">Prénom :</label>
            <input class="form-control" type="text" placeholder="Prénom" id="Prenom" name="Prenom"
                value="<?= $Prenom_utilisateur ?>">
            <label for="">Promo :</label>
            <select class="form-control" type="text" name="Promo" id="Promo" value="<?= $Id_promo_utilisateur ?>">
                <?php echo $options; ?>
            </select>
            <label for="">Email :</label>
            <input class="form-control" type="mail" placeholder="Email" id="Mail" name="Mail"
                value="<?= $Mail_utilisateur ?>">
            <label for="">Téléphone :</label>
            <input class="form-control" type="tel" placeholder="Téléphone" id="Tel" name="Tel"
                value="<?= $Tel_utilisateur ?>">
            <label for="">Adresse :</label>
            <input class="form-control" type="text" placeholder="Adresse" id="Adresse" name="Adresse"
                value="<?= $Adresse_utilisateur ?>">
            <label for="" class="labelFile">Choisir une image</label>
            <input class="inputFile" type="file" id="Photo_profil" name="Photo_profil" value="<?= $Photo_profil_utilisateur ?>">
            <h2 class='title'>Mot de passe</h2>
            <label for="">Mot de passe :</label>
            <input class="form-control" type="text" placeholder="Créer un mot de passe" id="Mot_de_passe"
                name="Mot_de_passe" value="<?= $Mot_de_passe_utilisateur ?>">
            <label for="">Confirmation mot de passe :</label>
            <input class="form-control" type="text" placeholder="Confirmer le mot de passe"
                id="Confirmation_mot_de_passe" name="Confirmation_mot_de_passe">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    J'accepte les conditions d'utilisation de ce site
                </label>
            </div>
            <div class="button">
                <button type="button" class="btn btn-primary btn-lg" id="buttonAnnuler">Annuler</button>
                <button type="button" class="btn btn-primary btn-lg" id="buttonAccepter">Créer un compte</button>
            </div>
        </form>
    </div>

    <footer class="footer">
        <div class="logo">
            <img id="logoCarpoolFooter" src="/images/logoCarpool.png" alt="">
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>