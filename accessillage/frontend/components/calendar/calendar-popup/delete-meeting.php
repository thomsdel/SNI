<?php
// Assurez-vous que le fichier de configuration de la base de données est inclus
require_once __DIR__ . '/../../../../backend/calendar/config.php';
require_once __DIR__ . '/../../../../backend/calendar/db.php';

// Récupérer les données de la requête (ID de la réunion)
$data = json_decode(file_get_contents('php://input'), true);
$meetingId = $data['id_rdv'] ?? null;

if ($meetingId) {
    // Préparer la requête pour supprimer la réunion
    $sql = "DELETE FROM rdv WHERE id_rdv = :id_rdv LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_rdv', $meetingId, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Impossible de supprimer la réunion.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de réunion manquant.']);
}
?>
