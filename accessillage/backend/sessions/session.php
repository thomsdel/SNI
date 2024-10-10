<?php
session_start(); // Démarre la session ou reprend une session existante

// Fonction pour vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['email']); // Vérifie si l'email est stocké dans la session
}

// Fonction pour connecter un utilisateur
function loginUser($email) {
    $_SESSION['email'] = $email; // Stocke l'email dans la session
}

// Fonction pour déconnecter un utilisateur
function logoutUser() {
    session_unset(); // Vide toutes les variables de session
    session_destroy(); // Détruit la session
}

// Fonction pour récupérer les informations de l'utilisateur connecté
function getCurrentUser() {
    return isset($_SESSION['email']) ? $_SESSION['email'] : null; // Retourne l'email ou null
}
?>
