<?php
require '../../backend/config/config.php'; 
require '../../backend/controllers/PatientController.php'; 

// Instanciation du contrôleur pour obtenir la liste des patients admis en consultation
$patientController = new PatientController($pdo); 
$patients = $patientController->getAllPatients(); 

// Inclusion des composants de navigation et des onglets
require '../components/navbar.php'; 
require '../components/onglet.php'; 
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
        <!-- Barre de recherche de patient -->
        <div class="patient-search-bar">
            <input type="text" id="search-input" placeholder="Rechercher un patient..." onkeyup="filterPatients(currentFilter)">
        </div>

        <!-- Tableau des patients -->
        <div id="patient-table-container">
            <table id="patient-table">
                <thead>
                    <tr>
                        <th data-filter="enregistrement" onclick="filterPatients('enregistrement')">Enregistré le</th>
                        <th data-filter="nom" onclick="filterPatients('nom')">Nom patient</th>
                        <th data-filter="id" onclick="filterPatients('id')">ID patient</th>
                        <th data-filter="annee" onclick="filterPatients('annee')">Année de naissance</th>
                    </tr>
                </thead>
                <tbody id="patient-list">
                    <?php if ($patients): ?>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?= htmlspecialchars($patient['date_enregistrement']) ?></td>
                                <td>
                                    <button 
                                        class="patient-name confidentiel" 
                                        onclick="openPatientPopup(<?= htmlspecialchars($patient['id_patient']) ?>)">
                                        <span class="confidentiel"><?= htmlspecialchars($patient['nom']) ?></span>
                                        <span class="confidentiel"><?= htmlspecialchars($patient['prenom']) ?></span>
                                    </button>
                                </td>
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

        <!-- Pop-up patient -->
        <div id="patient-popup" style="display:none">
            <div class="popup-overlay"></div> 
            <div class="popup-container">
                <div class="popup-header">
                    <h2>Profil</h2>
                    <span class="close-popup-btn">&times;</span>
                </div>
                <div class="popup-content">
                    <p>Prénom : <span id="prenom" class="confidentiel"></span></p>
                    <p>Nom : <span id="nom" class="confidentiel"></span></p>
                    <p>Sexe : <span id="sexe"></span></p>
                    <p>ID User : <span id="id_patient"></span></p>
                    <button onclick="redirectToDPI()">Accéder au DPI <span id="DPI"></span></button>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/script/popup.js"></script>
    <script src="../assets/script/patient.js"></script>
    <script src="../assets/script/accessibility.js"></script>
</body>
</html>
