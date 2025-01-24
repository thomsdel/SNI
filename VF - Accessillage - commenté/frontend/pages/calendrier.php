<?php
    require '../../backend/config/config.php'; // Inclure la connexion à la base de données
    require '../components/navbar.php'; // Inclure les header
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Calendrier</title>
        <link rel="stylesheet" href="../assets/styles/calendar/styles.css">
        <link rel="stylesheet" href="../assets/styles/styles.css">
    </head>
    <body>
        <div id="calendar">
            <!-- En-tête du calendrier avec les contrôles (navigation, affichage) -->
            <div id="calendar-header">
                <?php include '../components/calendar/calendar-controls.php'; ?> 
            </div>

            <!-- Corps du calendrier affichant les jours et événements -->
            <div id="calendar-body">
                <?php include '../components/calendar/calendar-body.php'; ?>
            </div>

            <!-- Popup pour la gestion des événements (création, affichage, modification) -->
            <div id="calendar-popup">
                <?php include '../components/calendar/calendar-popup/create-meeting/create-meeting.php'; ?>
                <?php include '../components/calendar/calendar-popup/show-meeting/show-meeting.php'; ?>
                <?php include '../components/calendar/calendar-popup/edit-meeting/edit-meeting.php'; ?>
            </div>
        </div>

        <!-- Inclusion des scripts JavaScript pour la gestion dynamique du calendrier -->
        <script type="module" src='../assets/script/popup.js'></script>
        <script type="module" src='../assets/script/calendar/calendar-controls.js'></script>
        <script type="module" src='../assets/script/calendar/calendar-body.js'></script>
        <script type="module" src='../assets/script/calendar/create-meeting.js'></script>
        <script type="module" src='../assets/script/calendar/edit-delete-meeting.js'></script>
    </body>
</html> 
