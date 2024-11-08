<?php
include  '../components/header/header.php'; // Inclut le bandeau
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Calendrier</title>
        <link rel="stylesheet" href="../assets/styles/calendar/styles.css">
    </head>
    <body>
        <div id="calendar">
            <div id="calendar-header">
                <?php include '../components/calendar/calendar-controls.php'; ?> 
            </div>
            <div id="calendar-body">
                <?php include '../components/calendar/calendar-body.php'; ?>
            </div>
            <?php include '../components/calendar/calendar-popup/popup-create-meeting.php'; ?>
            <?php include '../components/calendar/calendar-popup/meeting-popup.php'; ?>
            <?php include '../components/calendar/calendar-popup/edit-meeting-form.php'; ?>
        </div>

    <script type="module" src='../assets/scripts/calendar/calendar-controls.js'></script>
    <script type="module" src='../assets/scripts/calendar/calendar-body.js'></script>
    <script type="module" src='../assets/scripts/calendar/popup-create-meeting.js'></script>
    <script type="module" src='../assets/scripts/calendar/popup-show-meeting.js'></script>
    </body>
</html>

<?php
include  '../components/footer/footer.php'; // Inclut le bandeau
?> 
