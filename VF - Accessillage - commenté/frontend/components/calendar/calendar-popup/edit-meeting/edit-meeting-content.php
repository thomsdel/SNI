<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../../../backend/config/config.php';

// Récupérer les données envoyées par JSON
$data = json_decode(file_get_contents("php://input"), true);
$titre = $data['titre'] ?? '';
$secteur = $data['secteur'] ?? '';
$id_doc = $data['id_doc'] ?? null;
$id_patient = $data['id_patient'] ?? null;
$id_patient_dpi = $data['id_patient_dpi'] ?? null;  // Nouveau champ ajouté
$id_presc = $data['id_presc'] ?? null;
$date_rdv = $data['date_rdv'] ?? '';
$hour = $data['heure'] ?? '';
$duree = $data['duree'] ?? '';

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
?>

<form id="edit-meeting-form" action="" method="POST">
    <label for="titre_rdv">Titre de la réunion :</label>
    <input type="text" id="titre_rdv_edit" name="titre" value="<?= htmlspecialchars($titre); ?>" required>

    <label for="secteur_rdv">Secteur :</label>
    <input type="text" id="secteur_rdv" name="secteur" value="<?= htmlspecialchars($secteur); ?>" required>

    <label for="patient">Nom, Prénom du Patient :</label>
    <?php if ($id_patient_dpi !== null): ?>
        <!-- Si id_patient_dpi existe, afficher un champ texte avec le patient sélectionné -->
        <input type="text" id="patient" name="id_patient" value="<?= htmlspecialchars($patients[array_search($id_patient, array_column($patients, 'id_patient'))]['full_name']); ?>" disabled>
        <input type="hidden" name="id_patient" value="<?= $id_patient; ?>">
    <?php else: ?>
        <!-- Sinon, afficher un select classique -->
        <select id="patient" name="id_patient" required>
            <option value="">Sélectionnez un patient</option>
            <?php foreach ($patients as $patient): ?>
                <option value="<?= $patient['id_patient']; ?>" <?= $patient['id_patient'] == $id_patient ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($patient['full_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>

    <label for="medecin">Médecin :</label>
    <select id="medecin" name="id_doc" required>
        <option value="">Sélectionnez un médecin</option>
        <?php foreach ($doctors as $doctor): ?>
            <option value="<?= $doctor['id_doc']; ?>" <?= $doctor['id_doc'] == $id_doc ? 'selected' : ''; ?>>
                <?= htmlspecialchars($doctor['full_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="prescription">Prescription :</label>
    <select id="prescription" name="id_presc" required>
        <option value="">Sélectionnez une prescription</option>
        <?php foreach ($prescriptions as $prescription): ?>
            <option value="<?= $prescription['id_presc']; ?>" <?= $prescription['id_presc'] == $id_presc ? 'selected' : ''; ?>>
                <?= htmlspecialchars($prescription['medicament']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Séparation en deux champs pour la date et l'heure -->
    <label for="date">Date :</label>
    <input type="date" id="date" name="date_rdv" value="<?= $date_rdv; ?>" required>

    <label for="heure">Heure de début :</label>
    <input type="time" id="heure" name="heure" value="<?= $hour; ?>" required>

    <label for="duree_rdv">Durée (en minutes) :</label>
    <input type="number" id="duree_rdv" name="duree" value="<?= htmlspecialchars($duree); ?>" min="15" step="15" required>

    <button type="submit">Mettre à jour la réunion</button>
</form>
