<link rel="stylesheet" href="../assets/styles/calendar/popup/popup-month-Selector-styles.css">

<div id="month-selector-popup-container">
    <div class="popup-overlay" id="popup-show-overlay"></div>

    <div id="month-selector-popup">
        <h2>Choisir un mois</h2>
        <select id="month-select">
            <?php
            // Tableau des mois
            $months = [
                1 => 'Janvier',
                2 => 'Février',
                3 => 'Mars',
                4 => 'Avril',
                5 => 'Mai',
                6 => 'Juin',
                7 => 'Juillet',
                8 => 'Août',
                9 => 'Septembre',
                10 => 'Octobre',
                11 => 'Novembre',
                12 => 'Décembre'
            ];
            
            // Remplir le sélecteur avec les mois
            foreach ($months as $m => $monthName) {
                echo "<option value='$m'>$monthName</option>";
            }
            ?>
        </select>
        <select id="year-select">
            <?php
            // Année actuelle
            $currentYear = date('Y');
            $startYear = $currentYear - 1; // 1 ans avant
            $endYear = $currentYear + 10; // 10 ans après

            // Remplir le sélecteur avec les années centrées sur l'année actuelle
            for ($y = $startYear; $y <= $endYear; $y++) {
                $selected = ($y == $currentYear) ? 'selected' : ''; // Sélectionne l'année actuelle par défaut
                echo "<option value='$y' $selected>$y</option>";
            }
            ?>
        </select>
        <button id="confirm-date">Confirmer</button>
    </div>
</div>



