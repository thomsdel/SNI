<?php
require '../../backend/config/config.php'; 
require '../../backend/controllers/PatientController.php'; 
require '../../backend/controllers/PrescriptionController.php';

$patientController = new PatientController($pdo);
$prescriptionController = new PrescriptionController($pdo); 

if (isset($_GET['id_patient'])) {
    $id_patient = $_GET['id_patient']; // Récupère l'id du patient depuis l'URL
    $patient = $patientController->getPatient($id_patient);
    $prescriptions = $prescriptionController->getPrescriptions($id_patient);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_patient = $_GET['id_patient']; // Récupère l'id du patient depuis l'URL
    try {
        // Récupération des données
        $data = [
            'medicament' => $_POST['medicament'],
            'dose' => $_POST['dose'],
            'voie' => $_POST['voie'],
            'duree_presc' => $_POST['duree_presc'],
            'date_presc' => $_POST['date_presc'],
            'id_patient' => $id_patient,
        ];

        // Requête SQL
        $stmt = $pdo->prepare("INSERT INTO prescription (medicament, dose, voie, duree_presc, date_presc, id_patient)
                               VALUES (:medicament, :dose, :voie, :duree_presc, :date_presc, :id_patient)");
        $result = $stmt->execute($data);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "";
}

// Inclusion des composants de navigation et des onglets
require '../components/navbar.php'; 
require '../components/onglet_patient.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Médicale</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
    <div class="container">
        <div class="column">
            <div class="section-card">
                <h2>Ajouter une prescription</h2>
                <form method="POST">

                    <div class="row">
                        <!-- Médicament -->
                        <label for="medicament">Médicament :</label>
                        <input type="text" name="medicament" id="medicament" class="confidentiel" required>
                        <br><br>
                    </div>

                    <div class="row">
                        <!-- Dose -->
                        <label for="dose">Dose :</label>
                        <input type="text" name="dose" id="dose" required>
                        <br><br>
                    </div>

                    <div class="row">
                        <!-- Voie d'administration -->
                        <label for="voie">Voie d'administration :</label>
                        <input type="text" name="voie" id="voie" class="confidentiel" required>
                        <br><br>
                    </div>

                    <div class="row">
                        <!-- Durée de la prescription -->
                        <label for="duree_presc">Durée de la prescription en jours :</label>
                        <input type="number" name="duree_presc" id="duree_presc" required>
                        <br><br>
                    </div>

                    <div class="row">
                        <!-- Date de la prescription -->
                        <label for="date_presc">Date de début de la prescription :</label>
                        <input type="datetime-local" name="date_presc" id="date_presc" required>
                        <br><br>
                    </div>

                    <div class="row">
                        <!-- Bouton d'envoi -->
                        <button type="submit" name="submit" value="submit">Ajouter la prescription</button>
                    </div>

                </form>
            </div>
        </div>


        <div class="column">
            <div class="section-card">
                <!-- Historique des prescriptions -->
                <h2>Historique des prescriptions</h2>

                <?php if (!empty($prescriptions)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th class="confidentiel">Médicament</th>
                                <th>Date</th>
                                <th class="confidentiel">Voie d'administration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prescriptions as $prescription): ?>
                                <tr>
                                    <td class="confidentiel"><?= htmlspecialchars($prescription['medicament']); ?></td>
                                    <td><?= htmlspecialchars($prescription['date_presc']); ?></td>
                                    <td class="confidentiel"><?= htmlspecialchars($prescription['voie']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucune prescription trouvée pour ce patient.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <script type="module" src='../assets/script/popup.js'></script>
    <script type="module" src='../assets/script/accessibility.js'></script>
</body>
</html>
