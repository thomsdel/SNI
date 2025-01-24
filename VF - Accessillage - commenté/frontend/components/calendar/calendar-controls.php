<link rel="stylesheet" href="../assets/styles/calendar/calendar-controls-styles.css">

<div id="controls" class="calendar-controls">
    <!-- Icône du calendrier -->
    <img id="calendar-icon" src="../assets/images/calendar/icon-calendar.png" alt="Calendrier Icon">

    <!-- Bouton Aujourd'hui -->
    <button id="today-button">Aujourd'hui</button>

    <!-- Navigation Jour/Semaine -->
    <button id="prev-date-button">◀</button> <!-- Flèche gauche -->
    <button id="next-date-button">▶</button> <!-- Flèche droite -->

    <!-- Navigation Mois/Année -->
    <button id="prev-month-button">◀</button> <!-- Flèche gauche pour mois -->
    <span id="current-month" tabindex="0"></span>
    <button id="next-month-button">▶</button> <!-- Flèche droite pour mois -->

    <!-- Sélecteur de mode d'affichage -->
    <div class="view-mode">
        <button id="view-mode-button">
            <?= 'Semaine'?> 
        </button>
    </div>

    <!-- Bouton Création de Réunion -->
    <button id="new-meeting-button">+</button>

    <!-- Popup de sélection de mois -->
    <?php include 'calendar-popup/month-selector.php'; ?>
</div>


