<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../../../backend/config/config.php';

// Récupérer la date et l'heure envoyées par la requête
$data = json_decode(file_get_contents("php://input"), true);
$date_rdv = $data['date_rdv'] ?? null;
$hour = $data['hour'] ?? null;
$id_patient = $data['id_patient'] ?? null;


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

$prescriptionsQuery = "SELECT id_presc, medicament FROM prescription";
$prescriptionsStmt = $pdo->query($prescriptionsQuery);
$prescriptions = $prescriptionsStmt->fetchAll(PDO::FETCH_ASSOC);

// Si un patient est spécifié, on récupère ses informations
$selected_patient_name = null;
if ($id_patient) {
    $patientQuery = "SELECT CONCAT(nom, ' ', prenom) AS full_name FROM patient WHERE id_patient = :id_patient";
    $stmt = $pdo->prepare($patientQuery);
    $stmt->bindParam(':id_patient', $id_patient, PDO::PARAM_INT);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    $selected_patient_name = $patient['full_name'] ?? null;
}
?>

<form id="create-meeting-form" action="" method="POST">
    <!-- Champs de formulaire -->
    <label for="titre_rdv">Titre de la réunion :</label>
    <input type="text" id="titre_rdv_create" name="titre" required>

    <label for="secteur_rdv">Secteur :</label>
    <input type="text" id="secteur_rdv" name="secteur" required>

    <!-- Si id_patient est défini, on affiche le nom du patient et on le rend non modifiable -->
    <label for="patient">Nom, Prénom du Patient :</label>
    <?php if ($selected_patient_name): ?>
        <input type="text" id="patient" name="id_patient" value="<?= htmlspecialchars($selected_patient_name); ?>" readonly>
        <input type="hidden" name="id_patient" value="<?= $id_patient; ?>"> <!-- Envoie de l'id du patient en tant que champ caché -->
    <?php else: ?>
        <select id="patient" name="id_patient" required>
            <option value="">Sélectionnez un patient</option>
            <?php foreach ($patients as $patient): ?>
                <option value="<?= $patient['id_patient']; ?>"><?= $patient['full_name']; ?></option>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>

    <label for="medecin">Médecin :</label>
    <select id="medecin" name="id_doc" required>
        <option value="">Sélectionnez un médecin</option>
        <?php foreach ($doctors as $doctor): ?>
            <option value="<?= $doctor['id_doc']; ?>"><?= $doctor['full_name']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="prescription">Prescription :</label>
    <select id="prescription" name="id_presc" required>
        <option value="">Sélectionnez une prescription</option>
        <?php foreach ($prescriptions as $prescription): ?>
            <option value="<?= $prescription['id_presc']; ?>"><?= $prescription['medicament']; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Séparation en deux champs pour la date et l'heure -->
    <label for="date">Date :</label>
    <input type="date" id="date" name="date_rdv" value="<?= $date_rdv; ?>" required>

    <label for="heure">Heure de début :</label>
    <input type="time" id="heure" name="heure" value="<?= $hour; ?>" required>

    <label for="duree_rdv">Durée (en minutes) :</label>
    <input type="number" id="duree_rdv" name="duree" min="15" step="15" required>

    <button type="submit">Créer la réunion</button>
</form>
