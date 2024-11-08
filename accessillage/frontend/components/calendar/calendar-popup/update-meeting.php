<?php
// Assurez-vous que le fichier de configuration de la base de données est inclus
require_once __DIR__ . '/../../../../backend/calendar/config.php';
require_once __DIR__ . '/../../../../backend/calendar/db.php';

$data = json_decode(file_get_contents('php://input'), true);

$meetingId = $data['id_rdv'] ?? null;
$title = $data['title'] ?? null;
$sector = $data['sector'] ?? null;
$startDate = $data['startDate'] ?? null;
$duration = $data['duration'] ?? null;
$remarks = $data['remarks'] ?? null;
$doctor = $data['doctor'] ?? null;
$patient = $data['patient'] ?? null;

if ($meetingId && $title && $sector && $startDate && $duration) {
    // Préparer la requête pour mettre à jour la réunion
    $sql = "UPDATE rdv 
            SET titre_rdv = :title, secteur = :sector, date_debut = :startDate, duree = :duration, remarques = :remarks, id_doc = :doctor, id_patient = :patient
            WHERE id_rdv = :id_rdv LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_rdv', $meetingId, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':sector', $sector, PDO::PARAM_STR);
    $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
    $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
    $stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
    $stmt->bindParam(':doctor', $doctor, PDO::PARAM_INT);
    $stmt->bindParam(':patient', $patient, PDO::PARAM_INT);

    // Exécuter la requête de mise à jour
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Impossible de mettre à jour la réunion.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Données manquantes pour la mise à jour.']);
}
?>
