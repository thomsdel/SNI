<link rel="stylesheet" href="../assets/styles/calendar/calendar-controls-styles.css">

<div id="controls" class="calendar-controls">
    <!-- Icône du calendrier -->
    <img id="calendarIcon" src="../assets/images/calendar/icon-calendar.png" alt="Calendrier Icon">

    <!-- Bouton Aujourd'hui -->
    <button id="todayButton">Aujourd'hui</button>

    <!-- Navigation Jour/Semaine -->
    <button id="prevDateButton">◀</button> <!-- Flèche gauche -->
    <button id="nextDateButton">▶</button> <!-- Flèche droite -->

    <!-- Navigation Mois/Année -->
    <button id="prevMonthButton">◀</button> <!-- Flèche gauche pour mois -->
    <span id="currentMonth"></span>
    <button id="nextMonthButton">▶</button> <!-- Flèche droite pour mois -->

    <!-- Sélecteur de mode d'affichage -->
    <div class="view-mode">
        <button id="viewModeButton">
            <?= 'Semaine'?> 
        </button>
    </div>

    <!-- Popup de sélection de mois -->
    <?php include 'calendar-popup/monthSelector-popup.php'; ?>
</div>


