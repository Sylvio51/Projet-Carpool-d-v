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
</head>
<body>
    <button onclick="togglePopup()">Activer le popup</button>

    <div id="popup-overlay">
        <div class="popup-content">
            <a href="javascript:void(0)" onclick="togglePopup()" class="popup-exit">Fermer</a>
            <br>
            <img src="imgs/connexion2.png" alt="">
            <h2>Connexion</h2>
            <form action="">
            <input type="text" name="mail" placeholder="Email">
            <br>
            <input type="text" name="mdp" placeholder="Mot de passe">
            <br>
            <a href="/" class="popup-link">Se connecter</a>
            <br>
            <a href="/">S'inscrire</a>
        </form>
        </div>
    </div>

<script src="JS/script-index.js"></script>
</body>
</html>