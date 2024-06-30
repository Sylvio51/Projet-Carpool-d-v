<?php session_start();
if (!isset($_SESSION['connecter']) || $_SESSION['connecter'] != "je suis connecté") {
    echo "<script>
        alert('Veuillez vous connecter pour pouvoir effectuer des recherches.');
        window.location.href = '/accueil.php';
        </script>";
    exit();
}
?>