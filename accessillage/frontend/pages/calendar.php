<?php
    require '../../backend/config/config.php'; // Inclure la connexion à la base de données
    require '../components/header/header.php'; // Inclure le header
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Calendrier</title>
        <link rel="stylesheet" href="../assets/styles/calendar/styles.css">
        <link rel="stylesheet" href="../assets/styles/calendar/popup/popups.css">
    </head>
    <body>
        <div id="calendar">
            <div id="calendar-header">
                <?php include '../components/calendar/calendar-controls.php'; ?> 
            </div>
            <div id="calendar-body">
                <?php include '../components/calendar/calendar-body.php'; ?>
            </div>
            <div id="calendar-popup">
                <?php include '../components/calendar/calendar-popup/create-meeting/create-meeting.php'; ?>
                <?php include '../components/calendar/calendar-popup/show-meeting/show-meeting.php'; ?>
                <?php include '../components/calendar/calendar-popup/edit-meeting/edit-meeting.php'; ?>
            </div>
        </div>

        <script type="module" src='../assets/scripts/calendar/calendar-controls.js'></script>
        <script type="module" src='../assets/scripts/calendar/calendar-body.js'></script>
        <script type="module" src='../assets/scripts/calendar/create-meeting.js'></script>
        <script type="module" src='../assets/scripts/calendar/edit-delete-meeting.js'></script>
    </body>
</html>

<?php
include  '../components/footer/footer.php'; // Inclut le bandeau
?> 
