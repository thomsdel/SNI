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
    $id_presc = $rdvData['id_presc'];

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

    // Récupérer la presciption
    $prescriptionQuery = "SELECT medicament FROM prescription WHERE id_presc = :id_presc";
    $prescriptionStmt = $pdo->prepare($prescriptionQuery);
    $prescriptionStmt->bindParam(':id_presc', $id_presc, PDO::PARAM_INT);
    $prescriptionStmt->execute();
    $prescription = $prescriptionStmt->fetch(PDO::FETCH_ASSOC);
    $medicament = $prescription['medicament'] ?? 'Inconnu';

    // Afficher les détails du rendez-vous
    echo "<h3>Réunion : " . htmlspecialchars($rdvData['titre']) . "</h3>";
    echo "<p>Patient : " . htmlspecialchars($patientName) . "</p>";
    echo "<p>Médecin : " . htmlspecialchars($doctorName) . "</p>";
    echo "<p>Prescription : " . htmlspecialchars($medicament) . "</p>";
    echo "<p>Date : " . htmlspecialchars($rdvData['date_rdv']) . "</p>";
    echo "<p>Heure de début : " . htmlspecialchars($rdvData['heure']) . "</p>";
    echo "<p>Secteur : " . htmlspecialchars($rdvData['secteur']) . "</p>";
    echo "<p>Durée : " . htmlspecialchars($rdvData['duree']) . "</p>";
} else {
    echo "<p>Erreur dans la récupération des informations de la réunion.</p>";
}
?>
