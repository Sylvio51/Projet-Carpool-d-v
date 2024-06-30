<?php session_start();
if (!isset($_SESSION['user_connected']) || $_SESSION['user_connected'] != "ok") {
    echo "<script>
        alert('Veuillez vous connecter pour pouvoir effectuer des recherches.');
        window.location.href = '/accueil.php';
        </script>";
    exit();
}
?>