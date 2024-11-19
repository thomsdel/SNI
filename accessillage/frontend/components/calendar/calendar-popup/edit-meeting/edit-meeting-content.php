<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../../../backend/config/config.php';

// Récupérer les données envoyées par JSON
$data = json_decode(file_get_contents("php://input"), true);
$titre = $data['titre_rdv'] ?? '';
$secteur = $data['secteur'] ?? '';
$id_doc = $data['id_doc'] ?? null;
$id_patient = $data['id_patient'] ?? null;
$date_debut = $data['date_debut'] ?? '';
$hour = date('H:i', strtotime($date_debut)); // Extraction de l'heure
$date = date('Y-m-d', strtotime($date_debut)); // Extraction de la date
$duree = $data['duree'] ?? '';
$remarques = $data['remarques'] ?? '';

// Récupérer les patients et docteurs depuis la base de données
$patientsQuery = "SELECT id_patient, CONCAT(nom, ' ', prenom) AS full_name FROM patient";
$patientsStmt = $pdo->query($patientsQuery);
$patients = $patientsStmt->fetchAll(PDO::FETCH_ASSOC);

$doctorsQuery = "SELECT id_doc, CONCAT(nom_doc, ' ', prenom_doc) AS full_name FROM docteur";
$doctorsStmt = $pdo->query($doctorsQuery);
$doctors = $doctorsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form id="edit-meeting-form" action="" method="POST">
    <label for="titre_rdv">Titre de la réunion :</label>
    <input type="text" id="titre_rdv" name="titre_rdv" value="<?= htmlspecialchars($titre); ?>" required>

    <label for="secteur_rdv">Secteur :</label>
    <input type="text" id="secteur_rdv" name="secteur" value="<?= htmlspecialchars($secteur); ?>" required>

    <label for="patient">Nom, Prénom du Patient :</label>
    <select id="patient" name="id_patient" required>
        <option value="">Sélectionnez un patient</option>
        <?php foreach ($patients as $patient): ?>
            <option value="<?= $patient['id_patient']; ?>" <?= $patient['id_patient'] == $id_patient ? 'selected' : ''; ?>>
                <?= htmlspecialchars($patient['full_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="medecin">Médecin :</label>
    <select id="medecin" name="id_doc" required>
        <option value="">Sélectionnez un médecin</option>
        <?php foreach ($doctors as $doctor): ?>
            <option value="<?= $doctor['id_doc']; ?>" <?= $doctor['id_doc'] == $id_doc ? 'selected' : ''; ?>>
                <?= htmlspecialchars($doctor['full_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="date_debut_rdv">Date et Heure de début :</label>
    <input type="datetime-local" id="date_debut_rdv" name="date_debut" value="<?= $date . 'T' . $hour; ?>" required>

    <label for="duree_rdv">Durée (en minutes) :</label>
    <input type="number" id="duree_rdv" name="duree" value="<?= htmlspecialchars($duree); ?>" min="15" step="15" required>

    <label for="remarques_rdv">Remarques :</label>
    <textarea id="remarques_rdv" name="remarques"><?= htmlspecialchars($remarques); ?></textarea>

    <button type="submit">Mettre à jour la réunion</button>
</form>
