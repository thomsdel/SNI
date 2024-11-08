<div id="monthSelector-popup">
    <h2>Choisir un mois</h2>
    <select id="monthSelect">
        <?php
        // Tableau des mois en français avec majuscule
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
    <select id="yearSelect">
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
    <button id="confirmDate">Confirmer</button>
</div>


