<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controllers/PrescriptionController.php';

// Création du contrôleur des prescriptions
$prescriptionController = new PrescriptionController($pdo);

// Ajout d'une prescription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prescriptionData= [
            'medicament' => $_POST['medicament'],
            'duree_presc' => $_POST['duree_presc'],
            'id_patient' => $_GET['id_patient'],
            'date_presc' => $_POST['date_presc'],
            'dose' => $_POST['dose'],
            'voie' => $_POST['voie'],
        ];

        $prescriptionController->addPrescription($prescriptionData);
}


// Route pour récupérer les informations d'une prescription
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_presc'])) {
    $prescription = $prescriptionController->getPrescription($_GET['id_presc']);
    // Traiter le résultat (par exemple, le renvoyer au frontend)
}

// Route pour mettre à jour une prescription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $data = [
        'medicament' => $_POST['medicament'],
        'frequence' => $_POST['frequence'],
        'duree_presc' => $_POST['duree_presc'],
        'quantite' => $_POST['quantite'],
        'gramme' => $_POST['gramme'],
        'voie' => $_POST['voie']
    ];
    $prescriptionController->updatePrescription($_POST['id_presc'], $data);
}

// Route pour supprimer une prescription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $prescriptionController->deletePrescription($_POST['id_presc']);
}