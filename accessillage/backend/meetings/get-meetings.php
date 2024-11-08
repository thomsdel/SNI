<?php
$host = 'localhost';
$db = 'accessillage'; // Nom de votre base de données
$user = 'root'; // Votre nom d'utilisateur
$pass = ''; // Votre mot de passe

// Connexion à la base de données
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}

// Récupérer la date passée en paramètre
$date = $_GET['date'];

// Interroger la base de données pour les réunions
$stmt = $pdo->prepare("SELECT titre_rdv, date_debut, HOUR(date_debut) AS heure_debut FROM rdv WHERE DATE(date_debut) = :date");
$stmt->execute(['date' => $date]);
$meetings = $stmt->fetchAll();

// Renvoyer les résultats au format JSON
header('Content-Type: application/json');
echo json_encode($meetings);
?>
