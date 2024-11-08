<?php
// Assurez-vous que le fichier de configuration de la base de données est inclus
require_once __DIR__ . '/../../../../backend/calendar/config.php';
require_once __DIR__ . '/../../../../backend/calendar/db.php';

// Définir le type de contenu à JSON
header('Content-Type: application/json');

// Récupérer les données de la requête (l'ID de la réunion)
$data = json_decode(file_get_contents('php://input'), true);
$meetingId = $data['id_rdv'] ?? null;

if ($meetingId) {
    // Récupérer les informations de la réunion
    $meetingQuery = "SELECT * FROM rdv WHERE id_rdv = :id_rdv LIMIT 1";
    $stmt = $pdo->prepare($meetingQuery);
    $stmt->execute(['id_rdv' => $meetingId]);
    $meeting = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les patients et docteurs depuis la base de données
    $patientsQuery = "SELECT id_patient, CONCAT(nom, ' ', prenom) AS full_name FROM patient";
    $patientsStmt = $pdo->query($patientsQuery);
    $patients = $patientsStmt->fetchAll(PDO::FETCH_ASSOC);

    $doctorsQuery = "SELECT id_doc, CONCAT(nom_doc, ' ', prenom_doc) AS full_name FROM docteur";
    $doctorsStmt = $pdo->query($doctorsQuery);
    $doctors = $doctorsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Format de la date pour l'input datetime-local
    $formattedDate = date('Y-m-d\TH:i', strtotime($meeting['date_debut']));

    // Retourner les données au format JSON
    echo json_encode([
        'status' => 'success',
        'meeting' => [
            'id_rdv' => $meeting['id_rdv'],
            'titre_rdv' => $meeting['titre_rdv'],
            'secteur' => $meeting['secteur'],
            'date_debut' => $formattedDate,
            'duree' => $meeting['duree'],
            'remarques' => $meeting['remarques'],
            'id_doc' => $meeting['id_doc'],
            'id_patient' => $meeting['id_patient']
        ],
        'doctors' => $doctors,
        'patients' => $patients
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de réunion manquant.']);
}
?>

