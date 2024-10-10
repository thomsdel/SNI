<?php
require_once '../controllers/PrescriptionController.php'; // Inclure le contrôleur des prescriptions
require '../config/config.php'; // Inclure la connexion à la base de données

$prescriptionController = new PrescriptionController($pdo);

// Gestion des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Route pour ajouter une prescription
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $prescriptionController->addPrescription($_POST['medicament'], $_POST['frequence'], $_POST['duree_presc']);
    }
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
        'duree_presc' => $_POST['duree_presc']
    ];
    $prescriptionController->updatePrescription($_POST['id_presc'], $data);
}

// Route pour supprimer une prescription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $prescriptionController->deletePrescription($_POST['id_presc']);
}
?>
