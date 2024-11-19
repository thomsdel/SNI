<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../../../backend/config/config.php';

// Récupérer les données envoyées depuis JavaScript
$rdvData = json_decode(file_get_contents('php://input'), true);

// Vérifier si les données ont été envoyées correctement
if ($rdvData) {
    // Extraire l'ID du patient et du docteur
    $id_patient = $rdvData['id_patient'];
    $id_doc = $rdvData['id_doc'];

    // Récupérer le nom complet du patient
    $patientQuery = "SELECT CONCAT(nom, ' ', prenom) AS full_name FROM patient WHERE id_patient = :id_patient";
    $patientStmt = $pdo->prepare($patientQuery);
    $patientStmt->bindParam(':id_patient', $id_patient, PDO::PARAM_INT);
    $patientStmt->execute();
    $patient = $patientStmt->fetch(PDO::FETCH_ASSOC);
    $patientName = $patient['full_name'] ?? 'Inconnu';

    // Récupérer le nom complet du docteur
    $doctorQuery = "SELECT CONCAT(nom_doc, ' ', prenom_doc) AS full_name FROM docteur WHERE id_doc = :id_doc";
    $doctorStmt = $pdo->prepare($doctorQuery);
    $doctorStmt->bindParam(':id_doc', $id_doc, PDO::PARAM_INT);
    $doctorStmt->execute();
    $doctor = $doctorStmt->fetch(PDO::FETCH_ASSOC);
    $doctorName = $doctor['full_name'] ?? 'Inconnu';

    // Afficher les détails du rendez-vous
    echo "<h3>Réunion : " . htmlspecialchars($rdvData['titre_rdv']) . "</h3>";
    echo "<p>Heure de début : " . htmlspecialchars($rdvData['date_debut']) . "</p>";
    echo "<p>Secteur : " . htmlspecialchars($rdvData['secteur']) . "</p>";
    echo "<p>Durée : " . htmlspecialchars($rdvData['duree']) . "</p>";
    echo "<p>Remarques : " . htmlspecialchars($rdvData['remarques']) . "</p>";
    echo "<p>Patient : " . htmlspecialchars($patientName) . "</p>";
    echo "<p>Médecin : " . htmlspecialchars($doctorName) . "</p>";
} else {
    echo "<p>Erreur dans la récupération des informations de la réunion.</p>";
}
?>
