<?php
require '../../backend/config/config.php'; 
require '../../backend/controllers/PatientController.php'; 

$patientController = new PatientController($pdo); 

// Instanciation du contrôleur pour obtenir les données patient
$id_patient = $_GET['id_patient']; 
$patient = $patientController->getPatient($id_patient); 

// Inclusion des composants de navigation et des onglets
require '../components/navbar.php';
require '../components/onglet_patient.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Calendrier</title>
        <link rel="stylesheet" href="../assets/styles/calendar/styles.css">
        <link rel="stylesheet" href="../assets/styles/calendar/popup/popups.css">
        <link rel="stylesheet" href="../assets/styles/styles.css">
    </head>
    <body>
        <div id="calendar">

            <!-- En-tête du calendrier (contrôles de navigation, mois, etc.) -->
            <div id="calendar-header">
                <?php include '../components/calendar/calendar-controls.php'; ?> 
            </div>

            <!-- Corps du calendrier (affichage des jours, événements, etc.) -->
            <div id="calendar-body">
                <?php include "../components/calendar/calendar-body.php"; ?>
            </div>

            <!-- Popups du calendrier (création, affichage, modification de réunion) -->
            <div id="calendar-popup">
                <?php include '../components/calendar/calendar-popup/create-meeting/create-meeting.php'; ?>
                <?php include '../components/calendar/calendar-popup/show-meeting/show-meeting.php'; ?>
                <?php include '../components/calendar/calendar-popup/edit-meeting/edit-meeting.php'; ?>
            </div>
        </div>

        <!-- Scripts pour le fonctionnement du calendrier -->
        <script type="module" src='../assets/script/popup.js'></script>
        <script type="module" src='../assets/script/calendar/calendar-controls.js'></script>
        <script type="module" src='../assets/script/calendar/calendar-body.js'></script>
        <script type="module" src='../assets/script/calendar/create-meeting.js'></script>
        <script type="module" src='../assets/script/calendar/edit-delete-meeting.js'></script>
    </body>
</html> 
