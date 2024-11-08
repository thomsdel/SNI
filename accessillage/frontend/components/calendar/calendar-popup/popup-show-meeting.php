<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../../backend/calendar/config.php';
require_once __DIR__ . '/../../../../backend/calendar/db.php';

// Récupérer l'ID de la réunion envoyé par la requête
$data = json_decode(file_get_contents("php://input"), true);
$id_rdv = $data['id_rdv'] ?? null;

if ($id_rdv) {
    // Requête SQL pour récupérer les détails de la réunion
    $sql = "SELECT rdv.*, docteur.nom_doc, docteur.prenom_doc, patient.nom, patient.prenom 
            FROM rdv
            LEFT JOIN docteur ON rdv.id_doc = docteur.id_doc
            LEFT JOIN patient ON rdv.id_patient = patient.id_patient
            WHERE rdv.id_rdv = :id_rdv";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_rdv', $id_rdv);
    $stmt->execute();
    $meeting = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($meeting) {
        // Générer le HTML avec les détails de la réunion
        echo '
            <h3>' . htmlspecialchars($meeting['titre_rdv']) . '</h3>
            <p><strong>Secteur:</strong> ' . htmlspecialchars($meeting['secteur']) . '</p>
            <p><strong>Patient:</strong> ' . htmlspecialchars($meeting['prenom']) . ' ' . htmlspecialchars($meeting['nom']) . '</p>
            <p><strong>Médecin:</strong> ' . htmlspecialchars($meeting['prenom_doc']) . ' ' . htmlspecialchars($meeting['nom_doc']) . '</p>
            <p><strong>Heure de début:</strong> ' . htmlspecialchars($meeting['date_debut']) . '</p>
            <p><strong>Durée:</strong> ' . htmlspecialchars($meeting['duree']) . ' minutes</p>
            <p><strong>Remarques:</strong> ' . htmlspecialchars($meeting['remarques']) . '</p>
        ';
    } else {
        echo 'Erreur: Réunion non trouvée';
    }
} else {
    echo 'Erreur: ID de réunion manquant';
}
?>
