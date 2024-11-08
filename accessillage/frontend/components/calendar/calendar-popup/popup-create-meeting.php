<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../../backend/calendar/config.php';
require_once __DIR__ . '/../../../../backend/calendar/db.php';

// Récupérer la date et l'heure envoyées par la requête
$data = json_decode(file_get_contents("php://input"), true);
$date = $data['date'] ?? null;
$hour = $data['hour'] ?? null;

// Ajouter des minutes si l'heure est donnée en format `HH`
if ($hour && strlen($hour) == 2) {
    $hour .= ":00";  // Ajouter les minutes par défaut
} else {
    $hour = "00:00";  // Au cas où il n'y a pas d'heure
}

// Récupérer les patients et docteurs depuis la base de données
$patientsQuery = "SELECT id_patient, CONCAT(nom, ' ', prenom) AS full_name FROM patient";
$patientsStmt = $pdo->query($patientsQuery);
$patients = $patientsStmt->fetchAll(PDO::FETCH_ASSOC);

$doctorsQuery = "SELECT id_doc, CONCAT(nom_doc, ' ', prenom_doc) AS full_name FROM docteur";
$doctorsStmt = $pdo->query($doctorsQuery);
$doctors = $doctorsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="popup-create-meeting">
    <div class="popup-create-meeting-container">
        <div class="create-meeting-form-header">
            <h2>Nouvelle Réunion</h2>
        </div>
        <form class="create-meeting-form" action="" method="POST" id="create-meeting-form">
            <label for="titre">Titre de la réunion :</label>
            <input type="text" id="titre_rdv" name="titre_rdv" required>

            <label for="secteur">Secteur :</label>
            <input type="text" id="secteur_rdv" name="secteur_rdv" required>

            <label for="patient">Nom, Prénom du Patient :</label>
            <select id="patient" name="patient" required>
                <option value="">Sélectionnez un patient</option>
                <?php foreach ($patients as $patient): ?>
                    <option value="<?= $patient['id_patient']; ?>"><?= $patient['full_name']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="medecin">Médecin :</label>
            <select id="medecin" name="medecin" required>
                <option value="">Sélectionnez un médecin</option>
                <?php foreach ($doctors as $doctor): ?>
                    <option value="<?= $doctor['id_doc']; ?>"><?= $doctor['full_name']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="date_debut">Date et Heure de début :</label>
            <input type="datetime-local" id="date_debut_rdv" name="date_debut_rdv" value="<?= $date . 'T' . $hour; ?>" required>

            <label for="duree">Durée (en minutes) :</label>
            <input type="number" id="duree_rdv" name="duree_rdv" min="15" step="15" required>

            <label for="remarques">Remarques :</label>
            <textarea id="remarques" name="remarques_rdv"></textarea>

            <button type="submit">Créer la réunion</button>
        </form>
    </div>
</div>

