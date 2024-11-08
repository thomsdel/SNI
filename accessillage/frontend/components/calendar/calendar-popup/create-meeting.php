<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../../backend/calendar/config.php';
require_once __DIR__ . '/../../../../backend/calendar/db.php';

// Récupérer les données envoyées via JSON
$data = json_decode(file_get_contents("php://input"), true);

// Extraction des données
$titre = $data['titre'] ?? null;
$secteur = $data['secteur'] ?? null;
$id_patient = $data['id_patient'] ?? null;
$id_doc = $data['id_doc'] ?? null;
$date_debut = $data['date_debut'] ?? null;
$duree = $data['duree'] ?? null;
$remarques = $data['remarques'] ?? null;

// Vérification des données
if ($titre && $secteur && $id_patient && $id_doc && $date_debut && $duree) {
    // Requête SQL pour insérer la réunion
    $sql = "INSERT INTO rdv (titre_rdv, id_patient, id_doc, secteur, date_debut, duree, remarques) 
            VALUES (:titre, :id_patient, :id_doc, :secteur, :date_debut, :duree, :remarques)";
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':id_patient', $id_patient, PDO::PARAM_INT);
    $stmt->bindParam(':id_doc', $id_doc, PDO::PARAM_INT);
    $stmt->bindParam(':secteur', $secteur);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
    $stmt->bindParam(':remarques', $remarques);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Réunion créée avec succès.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de la création de la réunion.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Données manquantes pour créer la réunion.'
    ]);
}
?>
