<?php
// Connexion à la base de données
$servername = "localhost"; // ou "127.0.0.1"
$username = "root"; // Nom d'utilisateur MySQL (par défaut avec WAMP c'est "root")
$password = ""; // Mot de passe, par défaut vide sur WAMP
$dbname = "accessillage"; // Nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$titre_rdv = $_POST['titre_rdv'];
$patients_rdv = $_POST['patients-rdv'];
$medecin_rdv = $_POST['medecin_rdv'];
$secteur_rdv = $_POST['secteur_rdv'];
$date_debut_rdv = $_POST['date_debut_rdv'];
$remarques_rdv = $_POST['remarques_rdv'];

// Préparer la requête SQL pour insérer les données dans la table `rdv`
$sql = "INSERT INTO rdv (titre_rdv, id_patient, id_doc, secteur, date_debut, remarques)
        VALUES (?, ?, ?, ?, ?, ?)";

// Préparer et exécuter la requête préparée pour éviter les injections SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $titre_rdv, $patients_rdv, $medecin_rdv, $secteur_rdv, $date_debut_rdv, $remarques_rdv);

if ($stmt->execute()) {
    echo "Réunion créée avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
