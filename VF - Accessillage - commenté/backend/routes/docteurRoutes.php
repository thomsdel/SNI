<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controllers/DocteurController.php';

// Création du contrôleur Docteur
$docteurController = new DocteurController($pdo);

// Ajout d'un docteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_doc') {
        $docteurController->addDocteur($_POST['nom'], $_POST['prenom'], $_POST['service']);
        echo "<div class='success'>Docteur ajouté avec succès !</div>";
}

// Récupération des informations d'un docteur
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_doc'])) {
    $docteur = $docteurController->getDocteur($_GET['id_doc']);
    // Traitement du résultat (par exemple, le renvoyer au frontend)
}

// Mise à jour des informations d'un docteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_doc') {
    $data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'service' => $_POST['service']
    ];
    $docteurController->updateDocteur($_POST['id_doc'], $data);
    echo "<div class='success'>Docteur mis à jour avec succès !</div>";
}

// Suppression d'un docteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_doc') {
    $docteurController->deleteDocteur($_POST['id_doc']);
    echo "<div class='success'>Docteur supprimé avec succès !</div>";
}
?>
