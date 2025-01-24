<?php
require '../../backend/config/config.php'; 
require '../../backend/controllers/PatientController.php'; 

// Instanciation du contrôleur pour obtenir la liste des patients admis en consultation
$patientController = new PatientController($pdo); 
$patientsAdmis = $patientController->getPatientsAdmis(); 

// Inclusion des composants de navigation et des onglets
require '../components/navbar.php'; 
require '../components/onglet.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admis en Consultation</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
    <div class="container">
        <!-- Table affichant les informations des patients admis -->
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date du rdv</th>
                    <th>Heure du rdv</th>
                    <th class="confidentiel">Nom Patient</th>
                    <th class="confidentiel">ID Patient</th>
                    <th class="confidentiel">Date de Naissance</th>
                    <th class="confidentiel">Secteur</th>
                </tr>
            </thead>
            <tbody>
                <!-- Parcours de la liste des patients admis et affichage des informations -->
                <?php foreach ($patientsAdmis as $patient): ?>
                    <tr>
                        <td><?= htmlspecialchars($patient['rdv_titre']) ?></td>
                        <td><?= htmlspecialchars($patient['rdv_date']) ?></td>
                        <td><?= htmlspecialchars($patient['rdv_heure']) ?></td>
                        <!-- Bouton pour afficher le popup avec le profil du patient -->
                        <td class="confidentiel">
                            <button class="patient-name" onclick="openPatientPopup(<?= htmlspecialchars($patient['id_patient']) ?>)">
                                <?= htmlspecialchars($patient['nom_patient']) ?> <?= htmlspecialchars($patient['prenom_patient']) ?>
                            </button>
                        </td>
                        <td class="confidentiel"><?= htmlspecialchars($patient['id_patient']) ?></td>
                        <td class="confidentiel"><?= htmlspecialchars($patient['date_naissance_patient']) ?></td>
                        <td class="confidentiel"><?= htmlspecialchars($patient['rdv_secteur']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pop-up affichant le profil d'un patient -->
    <div id="patient-popup" style="display:none;">
        <div class="popup-overlay"></div>
        <div class="popup-container">
            <div class="popup-header">
                <h2>Profil</h2>
                <span class="close-popup-btn">&times;</span>
            </div>
            <!-- Affichage des informations du patient sélectionné -->
            <div class="popup-content">
                <p class="confidentiel">Prénom : <span id="prenom"></span></p>
                <p class="confidentiel">Nom : <span id="nom"></span></p>
                <p>Sexe : <span id="sexe"></span></p>
                <p class="confidentiel">ID User : <span id="id_patient"></span></p>
                <!-- Bouton pour accéder au DPI du patient -->
                <button onclick="redirectToDPI()">Accéder au DPI <span id="DPI"></span></button>
                </div>
        </div>
    </div>

    <script src="../assets/script/patient.js"></script>
    
    <script src="../assets/script/accessibility.js"></script>
</body>
</html>
