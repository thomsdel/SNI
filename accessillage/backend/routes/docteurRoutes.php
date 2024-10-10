<?php
require_once '../controllers/DocteurController.php'; // Inclure le contrôleur des docteurs
require '../config/config.php'; // Inclure la connexion à la base de données

$docteurController = new DocteurController($pdo);

// Gestion des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Route pour ajouter un docteur
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $docteurController->addDocteur($_POST['nom'], $_POST['prenom'], $_POST['service']);
    }
}

// Route pour récupérer les informations d'un docteur
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_doc'])) {
    $docteur = $docteurController->getDocteur($_GET['id_doc']);
    // Traiter le résultat (par exemple, le renvoyer au frontend)
}

// Route pour mettre à jour un docteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'service' => $_POST['service']
    ];
    $docteurController->updateDocteur($_POST['id_doc'], $data);
}

// Route pour supprimer un docteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $docteurController->deleteDocteur($_POST['id_doc']);
}
?>
