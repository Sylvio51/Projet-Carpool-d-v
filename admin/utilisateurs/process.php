
$MessageErreur = "";
$Nom_utilisateur = "";
$Prenom_utilisateur = "";
$Mail_utilisateur = "";
$Tel_utilisateur = "";
$Id_promo_utilisateur = "";
$Adresse_utilisateur = "";
$Mot_de_passe_utilisateur = "";
$Confirmation_mot_de_passe = "";
$Photo_profil_utilisateur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $Nom_utilisateur = $_POST['Nom'];
    $Prenom_utilisateur = $_POST['Prenom'];
    $Mail_utilisateur = $_POST["Mail"];
    $Tel_utilisateur = $_POST["Tel"];
    $Id_promo_utilisateur = $_POST['Promo'];
    $Adresse_utilisateur = $_POST["Adresse"];
    $Mot_de_passe = $_POST["Mot_de_passe"];
    $Confirmation_mot_de_passe = $_POST["Confirmation_mot_de_passe"];
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
        // Vérifier si l'adresse e-mail existe déjà dans la base de données
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

            echo "<pre>" . var_dump($sql) . "</pre>";

        // Exécuter la requête
            if ($stmt->execute()) {
                echo "Compte créé avec succès.";
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