<?php
require_once '../controllers/RdvController.php'; // Inclure le contrôleur des rendez-vous
require '../config/config.php'; // Inclure la connexion à la base de données

$rdvController = new RdvController($pdo);

// Gestion des requêtes 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Route pour ajouter un rendez-vous
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $rdvController->addRdv($_POST['id_doc'], $_POST['num_secu'], $_POST['duree']);
    }
}

// Route pour récupérer les informations d'un rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_rdv'])) {
    $rdv = $rdvController->getRdv($_GET['id_rdv']);
    // Traiter le résultat (par exemple, le renvoyer au frontend)
}

// Route pour récupérer tous les rendez-vous d'un docteur
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_doc'])) {
    $rdvs = $rdvController->getRdvByDoctor($_GET['id_doc']);
    // Traiter le résultat
}

// Route pour récupérer tous les rendez-vous d'un patient
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['num_secu'])) {
    $rdvs = $rdvController->getRdvByPatient($_GET['num_secu']);
    // Traiter le résultat
}

// Route pour mettre à jour un rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $data = [
        'id_doc' => $_POST['id_doc'],
        'num_secu' => $_POST['num_secu'],
        'duree' => $_POST['duree']
    ];
    $rdvController->updateRdv($_POST['id_rdv'], $data);
}

// Route pour supprimer un rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $rdvController->deleteRdv($_POST['id_rdv']);
}
?>
