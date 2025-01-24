<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controllers/UserController.php';

// Création du contrôleur des utilisateurs
$userController = new UserController($pdo);

// Ajouter un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_user') {
        $userController->addUser($_POST['email'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['tel']);
        echo "<div class='success'> Utilisateur ajouté avec succès !</div>";
    }

// Connexion d'un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $user = $userController->loginUser($_POST['email'], $_POST['password']);
    if ($user) {
        loginUser($user['email_users'], $user['prenom_users'], $user['nom_users'], $user['id_users']);
        header("Location: liste_patient.php");
    } else {
        echo "<div class='success'> Identifiant ou mot de passe incorrect </div>";
    }
}

// Mise à jour des informations utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_user') {
    $data = [
        'email' => $_POST['email'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'tel' => $_POST['tel']
    ];
    $userController->updateUser($_POST['id_users'], $data);
    echo "<div class='success'>Utilisateur mis à jour avec succès !</div>";
}

// Suppression d'un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_user') {
    $userController->deleteUser($_POST['id_users']);
    echo "<div class='success'>Utilisateur supprimé avec succès !</div>";
}
?>