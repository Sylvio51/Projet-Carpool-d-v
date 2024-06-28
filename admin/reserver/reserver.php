<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/include/connect.php';

// Récupérer l'ID de l'annonce et l'ID de l'utilisateur (vous devrez probablement récupérer l'ID de l'utilisateur depuis la session)
$annonceId = $_POST['annonceId'];
$userId = $_SESSION['user_id'];

// Mettre à jour le nombre de places de l'annonce
$sql = "UPDATE annonce SET Nombre_places = Nombre_places - 1 WHERE Id = :annonceId";
$stmt = $db->prepare($sql);
$stmt->bindParam(':annonceId', $annonceId);
$stmt->execute();

// Récupérer la date de départ de l'annonce
$sql = "SELECT Date_depart FROM annonce WHERE Id = :annonceId";
$stmt = $db->prepare($sql);
$stmt->bindParam(':annonceId', $annonceId);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$dateDepart = $result['Date_depart'];

// Ajouter l'annonce à l'historique de l'utilisateur dans la table "reserver"
$sql = "INSERT INTO reserver (Id_utilisateur, Id_annonce, Date_depart) VALUES (:userId, :annonceId, :dateDepart)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':userId', $userId);
$stmt->bindParam(':annonceId', $annonceId);
$stmt->bindParam(':dateDepart', $dateDepart);
$stmt->execute();

// Retourner une réponse JSON indiquant le succès ou l'échec de l'opération
$response = array('success' => true);

// Empêcher l'affichage du code HTML
header('Content-Type: application/json');

// Afficher la réponse JSON
echo json_encode($response);
exit;