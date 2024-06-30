<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/include/connect.php';
$Nom_utilisateur = "";
$Prenom_utilisateur = "";
$Mail_utilisateur = "";
$Tel_utilisateur = "";
$Id_promo_utilisateur = "";
$Adresse_utilisateur = "";
$Mot_de_passe_utilisateur = "";
$Confirmation_mot_de_passe = "";
$Photo_profil_utilisateur = "";

if (isset($_POST['Mot_de_passe']) && isset($_POST['Confirmation_mot_de_passe'])) {
    var_dump($_POST);
    $Nom_utilisateur = htmlspecialchars($_POST['Nom']);
    $Prenom_utilisateur = htmlspecialchars($_POST['Prenom']);
    $Mail_utilisateur = htmlspecialchars($_POST["Mail"]);
    $Tel_utilisateur = htmlspecialchars($_POST["Tel"]);
    $Id_promo_utilisateur = htmlspecialchars($_POST['Promo']);
    $Adresse_utilisateur = htmlspecialchars($_POST["Adresse"]);
    $Mot_de_passe = htmlspecialchars($_POST["Mot_de_passe"]);
    $Confirmation_mot_de_passe = htmlspecialchars($_POST["Confirmation_mot_de_passe"]);
    $Photo_profil_utilisateur = [
        'name' => $_FILES["Photo_profil"]["name"],
        'type' => $_FILES["Photo_profil"]["type"],
        'tmp_name' => $_FILES["Photo_profil"]["tmp_name"],
        'error' => $_FILES["Photo_profil"]["error"],
        'size' => $_FILES["Photo_profil"]["size"]
    ];

    $Photo_profil_utilisateur_json = json_encode($Photo_profil_utilisateur);


    // Confirmation du mot de passe
    if ($Mot_de_passe === $Confirmation_mot_de_passe){
        // Vérification si l'adresse e-mail existe déjà dans la base de données
        $sql_check_email = "SELECT * FROM utilisateurs WHERE Mail_utilisateur = :email";    
        $stmt_check_email = $db->prepare($sql_check_email);
        $stmt_check_email->bindParam(':email', $Mail_utilisateur);
        $stmt_check_email->execute();

        if ($stmt_check_email->rowCount() > 0) {
            $MessageErreur = "Un compte avec cette adresse e-mail existe déjà.";
        } else {
            // Hashage du mot de passe
            $Mot_de_passe_utilisateur = password_hash($Mot_de_passe,PASSWORD_DEFAULT);

            //Préparation de la requête SQL
            $sql = "INSERT INTO utilisateurs (Nom_utilisateur, Prenom_utilisateur, Mot_de_passe_utilisateur, Mail_utilisateur, Adresse_utilisateur, tel_utilisateur, Photo_profil_utilisateur, Id_promo_utilisateur)
            VALUE (:Nom, :Prenom, :Mot_de_passe_utilisateur, :Mail, :Adresse, :Tel, :Photo_Profil, :Promo)";
            $stmt = $db->prepare($sql);

        // Ajout des valeurs dans la requête sql
            $stmt->bindParam(':Nom', $Nom_utilisateur);
            $stmt->bindParam(':Prenom', $Prenom_utilisateur);
            $stmt->bindParam(':Mot_de_passe_utilisateur', $Mot_de_passe_utilisateur);
            $stmt->bindParam(':Mail', $Mail_utilisateur);
            $stmt->bindParam(':Adresse', $Adresse_utilisateur);
            $stmt->bindParam(':Tel', $Tel_utilisateur);
            $stmt->bindParam(':Photo_Profil', $Photo_profil_utilisateur_json);
            $stmt->bindParam(':Promo', $Id_promo_utilisateur);

        // Exécuter la requête
            if ($stmt->execute()) {
                echo "Compte créé avec succès.";
                session_start();
                $_SESSION['Nom'] = $Nom_utilisateur . " " . $Prenom_utilisateur;
                header("Location:index.html");
                exit();
            } else {
                echo "Une erreur s'est produite lors de la création du compte.";
                var_dump($stmt->errorInfo());
            }
        }
    }else {
        $MessageErreur = "Les mots de passe ne correspondent pas.";
    }
}

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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="/admin/CSS/style_form.css">
    <title>S'enregistrer</title>
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

    <h1 class="d-flex justify-content-center title">Inscription</h1>
    <div class="container">
        <form action="" class="form" method="POST">
            <h2 class='title'>Information personelles</h2>
            <label for="">Nom :</label>
            <input class="form-control" type="text" placeholder="Nom" id="Nom" name="Nom"
                value="<?= $Nom_utilisateur ?>">
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
            <img id="photoLabel" src="/images/imagePDP.png" alt="photo de profil">
                <input accept="image/*" class="inputFile" type="file" id="Photo_profil" name="Photo_profil"
                value="<?= $Photo_profil_utilisateur ?>">    
            <h2 class='title title_pwd'>Mot de passe</h2>
            <label for="">Mot de passe :</label>
            <input class="form-control" type="password" placeholder="Créer un mot de passe" id="Mot_de_passe"
                name="Mot_de_passe" value="<?= $Mot_de_passe_utilisateur ?>">
            <label for="">Confirmation mot de passe :</label>
            <input class="form-control" type="password" placeholder="Confirmer le mot de passe"
                id="Confirmation_mot_de_passe" name="Confirmation_mot_de_passe">
            <div class="form-check">
                <label class="form-check-label" for="flexCheckDefault">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    J'accepte les conditions d'utilisation de ce site
                </label>
            </div>
            <div class="button">
                <button type="button" class="btn btn-primary btn-lg" id="buttonAnnuler">Annuler</button>
                <button type="submit" class="btn btn-primary btn-lg" id="buttonAccepter">Créer un compte</button>
            </div>
            <div class='text-danger'>
            <?php
                // if ($MessageErreur != "") {
                    // echo $MessageErreur;
                // }
                ?>
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
    <script src="/admin/JS/user-form.js"></script>
</body>

</html>