<?php 
try {
    $connexion = new PDO('mysql:host=localhost;dbname=carpool', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}
if(isset($_POST['envoi'])){
    if(!empty($_POST['Mail']) AND !empty($_POST['Mot_de_passe']) ) {
        $email = $_POST['Mail'];

        $stmt = $connexion->prepare("SELECT * FROM utilisateurs WHERE Mail_utilisateur = :Mail");
        $stmt -> bindParam(":Mail", $email);
        $stmt -> execute();

        $passwordAccount = $stmt->fetch();

        $email = htmlspecialchars($_POST['Mail']);
        $password = password_verify($_POST['Mot_de_passe'], $passwordAccount['Mot_de_passe_utilisateur']);


        $req = $connexion->prepare('SELECT * FROM utilisateurs WHERE Mail_utilisateur =:Mail AND Mot_de_passe_utilisateur =:mot_de_passe');
        $req -> bindParam(":Mail", $email);
        $req -> bindParam(":mot_de_passe", $password);
        $req->execute();
        $cpt = $req->rowCount();

        if($cpt == 1){
            $message = "votre compte a bien été trouvé";
            $info = $req->fetch();
            $_SESSION['id'] = $info['id_utilisateur'];
            $_SESSION['Nom'] = $info['Nom_utilisateur'];
            $_SESSION['Prenom'] = $info['Prenom_utilisateur'];
            $_SESSION['Mail'] = $info['Mail_utilisateur'];
            $_SESSION['Photo_profil'] = $info['Photo_profil_utilisateur'];
            $_SESSION['tel_'] = $info['tel_utilisateur'];
            $_SESSION['Id_promo'] = $info['Id_promo_utilisateur'];
            
            header("Location: profil.php?id=".$_SESSION['id']);
            
        }else{
            $message="Email ou mot de passe incorrect";
        }

    }else{
        $message="Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="CSS/connexion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
    <center>
    <div id="overlay" data-aos="fade-right">
        <div class="content">
            <br>
            <img src="imgs/connexion2.png" alt="">
            <h2>Connexion</h2>
            <form method="POST" action="">

            <input type="email" name="Mail" placeholder="Email" autocomplete="off">
            <br>
            <input type="password" name="Mot_de_passe" placeholder="Mot de passe" autocomplete="off">
            <br>
            
            <button type="submit" name="envoi" class="link">Se connecter</button>
            <br>
            <i style="color:red">
            <?php 
                if(isset($message)){
                    echo '<p class="error">'.$message.'</p>';
                }
            ?>
            </i>

            <p>
            Vous n'avez pas de compte ? <a href="admin/utilisateurs/form.php" class="inscription">S'inscrire</a>
            </p>
        </form>
        </div>
    </div>
</center>
<script>
AOS.init();
</script>
</body>
</html>