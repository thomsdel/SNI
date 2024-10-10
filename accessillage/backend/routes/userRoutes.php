<?php
require_once '../controllers/UserController.php'; // Inclure le contrôleur des utilisateurs
require '../config/config.php'; // Inclure la connexion à la base de données

$userController = new UserController($pdo);

// Gestion des requêtes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Route pour enregistrer un nouvel utilisateur
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $userController->registerUser($_POST['email'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['tel']);
    }

    // Route pour la connexion
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $result = $userController->loginUser($_POST['email'], $_POST['password']);
        if ($result) {
            // Connexion réussie, redirige ou traite la session
        } else {
            // Échec de la connexion
        }
    }
}

// Route pour mettre à jour un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $data = [
        'email' => $_POST['email'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'tel' => $_POST['tel']
    ];
    $userController->updateUser($_POST['id_users'], $data);
}

// Route pour supprimer un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $userController->deleteUser($_POST['id_users']);
}
?>
