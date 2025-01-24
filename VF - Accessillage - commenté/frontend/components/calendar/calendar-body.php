<link rel="stylesheet" href="../assets/styles/calendar/calendar-body-styles.css">

<?php
// Connexion à la base de données
require_once __DIR__ . '/../../../backend/config/config.php';

// Récupérer currentDate depuis la requête POST
$data = json_decode(file_get_contents("php://input"), true);
$currentDate = $data['currentDate'] ?? date('Y-m-d'); // Utilise la date par défaut si non fournie

// Vérifie si l'ID patient est fourni dans l'URL
$id_patient = $_GET['id_patient'] ?? ($data['id_patient'] ?? null);

// Créer un objet DateTime à partir de la date reçue
$currentDateObj = new DateTime($currentDate);

// Calculer la veille de currentDate pour commencer la semaine
$firstDayOfWeek = (clone $currentDateObj)->modify('-1 day');

// Définir les limites de la semaine pour la requête SQL
$startDate = $firstDayOfWeek->format('Y-m-d');
$endDate = (clone $firstDayOfWeek)->modify('+7 days')->format('Y-m-d');

if ($id_patient) {
    $sql = "SELECT * FROM rdv WHERE date_rdv BETWEEN :startDate AND :endDate AND id_patient = :id_patient";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':id_patient', $id_patient, PDO::PARAM_INT); // Lier le paramètre id_patient
} else {
    $sql = "SELECT * FROM rdv WHERE date_rdv BETWEEN :startDate AND :endDate";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
}

// Exécution de la requête
$stmt->execute();
$meetings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Grouper les réunions par date pour un affichage simplifié
$meetingsByDate = [];
foreach ($meetings as $meeting) {
    $meetingDate = $meeting['date_rdv'];
    $meetingsByDate[$meetingDate][] = $meeting;
}

// Fonction pour afficher le calendrier
function renderCalendar($firstDayOfWeek, $meetingsByDate) {
    echo '<table id="calendar-table">';
    echo '<tr><th class="hour-column"></th>'; // Cellule vide en haut à gauche

    // Affichage des jours de la semaine avec le numéro du jour
    $dayNames = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    foreach (range(0, 6) as $dayOffset) {
        $currentCellDate = (clone $firstDayOfWeek)->modify("+{$dayOffset} days")->format('Y-m-d');
        $dayNumber = (new DateTime($currentCellDate))->format('j');
        $dayName = (new DateTime($currentCellDate))->format('l');
        
        $dayNameInFrench = [
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche'
        ];
        
        // Ajouter une classe spéciale pour la deuxième colonne
        $highlightClass = ($dayOffset === 1) ? 'highlight-day' : '';
        
        echo "<th tabindex=\"0\" class=\"day-line $highlightClass\" data-date=\"$currentCellDate\">{$dayNameInFrench[$dayName]} $dayNumber</th>";
    }

    echo '</tr>';

    // Affichage des heures de 00h à 24h
    $hours = range(7, 20);
    foreach ($hours as $hour) {
        echo '<tr>';
        echo '<td class="hour-cell">' . sprintf('%02d', $hour) . 'h</td>'; // Affichage de l'heure dans la première colonne

        // Affichage des cellules de chaque jour
        foreach (range(0, 6) as $dayOffset) {
            $currentCellDate = (clone $firstDayOfWeek)->modify("+" . $dayOffset . " day")->format('Y-m-d');
            $meetingsForCell = $meetingsByDate[$currentCellDate] ?? [];

            // Vérifier s'il y a des réunions dans cette cellule
            $hasMeeting = false;
            $cellContent = ''; // Stocke le contenu HTML à insérer dans la cellule

            foreach ($meetingsForCell as $meeting) {
                $meetingHour = new DateTime($meeting['heure']);
                if ($meetingHour->format('H') == $hour) {
                    $durationInMinutes = $meeting['duree'];
                    $occupiedCells = $durationInMinutes / 60;
                    $occupiedCells = $occupiedCells + ($occupiedCells - 1) * 0.08; // Gestion des tailles des bordures

                    $meetingStyle = "background-color: #87CEEB; height: " . (100 * $occupiedCells) . "%;";
                    $cellContent .= '<div class="meeting" style="' . $meetingStyle . '" data-meeting-id="' . $meeting['id_rdv'] . '">';
                    $cellContent .= '<strong>' . htmlspecialchars($meeting['titre']) . '</strong>';
                    $cellContent .= '<p>' . htmlspecialchars($meeting['secteur']) . '</p>';
                    $cellContent .= '</div>';
                    $hasMeeting = true;
                    break; // On s'arrête après la première réunion affichée
                }
            }

            // Ajouter tabindex uniquement si la cellule contient une réunion
            $tabindexAttr = $hasMeeting ? ' tabindex="0"' : '';
            echo '<td class="calendar-cell" data-date="' . $currentCellDate . '" data-hour="' . sprintf('%02d', $hour) . '"' . $tabindexAttr . '>';
            echo $cellContent;
            echo '</td>';
        }
        echo '</tr>';
    }


    echo '</table>';
}

// Afficher le calendrier
renderCalendar($firstDayOfWeek, $meetingsByDate);

?>
