<?php
require '../components/navbar.php'; // Inclut le bandeau
require '../components/onglet.php'; // Inclut la gestion des onglets
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admis en Consultation</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
    <div class="container">
        <div id="consultation-table-container">
            <table id="consultation-table">
                <thead>
                    <tr>
                        <th class="sortable" data-column="date-enregistrement">Enregistrement le</th>
                        <th class="sortable" data-column="nom-patient">Nom Patient</th>
                        <th class="sortable" data-column="id-patient">ID Patient</th>
                        <th class="sortable" data-column="annee-naissance">Année de Naissance</th>
                        <th>Date de la Consultation</th>
                        <th>Service</th>
                    </tr>
                </thead>
                <tbody id="consultation-list">
                    <!-- Les patients seront chargés ici -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="../index.js"></script>
</body>
</html>
