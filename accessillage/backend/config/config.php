<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'siteweb'; // Nom de ta base de données
$username = 'root'; // Nom d'utilisateur (souvent 'root' pour WAMP par défaut)
$password = ''; // Mot de passe (souvent vide pour WAMP par défaut)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
