<?php
require '../components/navbar.php'; // Inclut le bandeau
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier avec Réunions / RDV</title>
    <link rel="stylesheet" href="s../assets/styles/styles.css">
</head>
<body>
    <header id="Header_buttons">
        <button id="todayButton">Aujourd'hui</button>
        <button id="prevButton" class="large">&lt;</button>
        <button id="nextButton" class="large">&gt;</button>
        <span id="currentMonth">Juin 2024</span>
        <select id="viewMode">
            <option value="week">Semaine</option>
            <option value="day">Jour</option>
        </select>
    </header>
    <main>
        <div id="calendar"></div>
    </main>
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Nouvelle Réunion / RDV</h2>
            <form id="meetingForm">
                <div class="form-group">
                    <label for="meetingTitle"><img src="icons_calendrier/icon-meeting.png" alt="Icone réunion"> Titre :</label>
                    <input type="text" id="meetingTitle" name="meetingTitle" required>
                </div>
                <div class="form-group">
                    <label for="meetingParticipants"><img src="icons_calendrier/icon-participants.png" alt="Icone participants"> Participants :</label>
                    <select id="meetingParticipants" name="meetingParticipants" required>
                        <option value="patient1">Patient 1</option>
                        <option value="patient2">Patient 2</option>
                        <option value="doctor1">Docteur 1</option>
                        <option value="doctor2">Docteur 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="meetingSector"><img src="icons_calendrier/icon-sector.png" alt="Icone secteur"> Secteur :</label>
                    <input type="text" id="meetingSector" name="meetingSector">
                </div>
                <div class="form-group">
                    <label for="meetingDuration"><img src="icons_calendrier/icon-duration.png" alt="Icone durée"> Durée (en heures) :</label>
                    <input type="number" id="meetingDuration" name="meetingDuration" min="1" max="24" required>
                </div>
                <div class="form-group">
                    <label for="additionalInfo"><img src="icons_calendrier/icon-info.png" alt="Icone informations"> Informations supplémentaires :</label>
                    <textarea id="additionalInfo" name="additionalInfo" rows="4"></textarea>
                </div>
                <button type="submit">Ajouter Réunion / RDV</button>
            </form>
        </div>
    </div>
    <div id="dateSelectorPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <div id="dateSelector"></div>
        </div>
    </div>
    
        <script src="../js/script.js"></script>
    <script src="script_calendrier.js"></script>
</body>
</html>






