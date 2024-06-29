<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/include/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/include/protect.php';

$annonceId = $_POST['annonceId'];
$userId = $_SESSION['user_id'];

$sql = "SELECT Nombre_places FROM annonce WHERE Id = :annonceId";
$stmt = $db->prepare($sql);
$stmt->bindParam(':annonceId', $annonceId);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nombrePlaces = $result['Nombre_places'];

if ($nombrePlaces > 0) {
    $sql = "UPDATE annonce SET Nombre_places = Nombre_places - 1 WHERE Id = :annonceId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':annonceId', $annonceId);
    $stmt->execute();

    $sql = "SELECT Date_depart FROM annonce WHERE Id = :annonceId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':annonceId', $annonceId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dateDepart = $result['Date_depart'];

    $sql = "INSERT INTO reserver (Id_utilisateur, Id_annonce, Date_depart) VALUES (:userId, :annonceId, :dateDepart)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':annonceId', $annonceId);
    $stmt->bindParam(':dateDepart', $dateDepart);
    $stmt->execute();

    $sql = "SELECT Mail_utilisateur FROM utilisateurs WHERE Id_utilisateur = (SELECT Id_utilisateur FROM annonce WHERE Id = :annonceId)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':annonceId', $annonceId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $emailAnnonceur = $result['Mail_utilisateur'];

    $response = array('success' => true);
} else {
    $response = array('success' => false, 'message' => 'Désolé, il n\'y a plus de places disponibles pour cette annonce. Veuillez réserver une autre annonce.');
}

header('Content-Type: application/json');

echo json_encode($response);
exit;
?>