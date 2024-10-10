<?php
require '../../backend/config/config.php'; // Inclure la connexion à la base de données
require '../../backend/controllers/PatientController.php'; // Inclure le contrôleur des patients

$patientController = new PatientController($pdo); // Crée une instance du PatientController
$patients = $patientController->getAllPatients(); // Récupère tous les patients

require '../components/navbar.php'; // Inclure la barre de navigation
require '../components/onglet.php'; // Inclut la gestion des onglets
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
    <div class="container">
        <div id="patient-table-container">
            <table id="patient-table">
                <thead>
                    <tr>
                        <th>Enregistrement le</th>
                        <th>Nom Patient</th>
                        <th>ID Patient</th>
                        <th>Année de Naissance</th>
                    </tr>
                </thead>
                <tbody id="patient-list">
                    <?php if ($patients): ?>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?= htmlspecialchars($patient['date_enregistrement']) ?></td>
                                <td><?= htmlspecialchars($patient['nom']) ?> <?= htmlspecialchars($patient['prenom']) ?></td>
                                <td><?= htmlspecialchars($patient['id_patient']) ?></td>
                                <td><?= date('Y', strtotime($patient['date_naissance'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Aucun patient trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
