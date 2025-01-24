<?php
// Démarre la session ou reprend une session existante
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configuration de la connexion à la base de données
$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'siteweb'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur 
$password = ''; // Mot de passe 

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Arrêt du script en cas d'erreur
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifie si un utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['email']); 
}

// Stocke les informations utilisateur dans la session après connexion
function loginUser($email, $prenom, $nom, $id_user) {
    $_SESSION['email'] = $email; 
    $_SESSION['prenom'] = $prenom; 
    $_SESSION['nom'] = $nom; 
    $_SESSION['id_user'] = $id_user; 
}

// Déconnecte l'utilisateur en supprimant les variables de session
function logoutUser() {
    session_unset();
}

// Retourne l'email de l'utilisateur connecté ou null si non connecté
function getCurrentUser() {
    return isset($_SESSION['email']) ? $_SESSION['email'] : null; // Retourne l'email ou null
}

?>
