<?php
require '../../backend/config/config.php'; // Inclure la connexion à la base de données
require '../../backend/controllers/PatientController.php'; // Inclure le contrôleur des patients

require '../components/navbar.php';
require '../components/onglet.php'; // Inclut la gestion des onglets

// Gestion du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Récupérer les valeurs du formulaire
        $patientData = [
            'num_secu' => $_POST['num_secu'],
            'civilite' => $_POST['civilite'],
            'sexe' => $_POST['sexe'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'nom_usage' => $_POST['nom_usage'],
            'date_naissance' => $_POST['date_naissance'],
            'lieu_naissance' => $_POST['lieu_naissance'],
            'situation_familiale' => $_POST['situation_familiale'],
            'profession' => $_POST['profession'],
            'enfants' => $_POST['enfants'],
            'mutuelle' => $_POST['mutuelle'],
            'adresse' => $_POST['adresse'],
            'code_postal' => $_POST['code_postal'],
            'ville' => $_POST['ville'],
            'email_patient' => $_POST['email_patient'],
            'tel_patient' => $_POST['tel_patient'],
            'id_doc' => $_POST['id_doc'],
            'date_enregistrement' => $_POST['date_enregistrement'],
        ];
        $patientController = new PatientController($pdo);
        $result = $patientController->addPatient($patientData);

        if ($result) {
            // Rediriger vers une page de succès    
            header("Location: liste_patient.php");
            exit();
        } else {
            $error = "Erreur lors de l'ajout du patient.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisie de la Fiche Administrative</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
    <div class="container">
        <h1>Saisie de la Fiche Administrative</h1>
        <form method="post">
            <!-- État Civil -->
            <h2>État Civil</h2>
            <label>Civilité:</label>
            <input type="radio" name="civilite" value="Sans" >Sans
            <input type="radio" name="civilite" value="Mme">Mme
            <input type="radio" name="civilite" value="Mlle">Mlle
            <input type="radio" name="civilite" value="Mr">Mr
            <label>Sexe:</label>
            <input type="radio" name="sexe" value="Masculin" >Masculin
            <input type="radio" name="sexe" value="Féminin">Féminin
            <label>Nom:</label>
            <input type="text" name="nom" >
            <label>Prénom:</label>
            <input type="text" name="prenom" >
            <label>Nom d'usage:</label>
            <input type="text" name="nom_usage">
            <label>Date de Naissance:</label>
            <input type="date" name="date_naissance" >
            <label>Lieu de Naissance:</label>
            <input type="text" name="lieu_naissance" >
            <label>Situation Familiale:</label>
            <input type="text" name="situation_familiale">
            <label>Nombre d'enfants:</label>
            <input type="number" name="enfants">
            <label>Profession:</label>
            <input type="text" name="profession">
            <!-- Téléphones & Email -->
            <h2>Téléphones & eMail</h2>
            <label>Portable:</label>
            <input type="text" name="tel_patient">
            <label>eMail:</label>
            <input type="email" name="email_patient">
            <!-- Situation Administrative -->
            <h2>Situation Administrative</h2>
            <label>Date d'enregistrement:</label>
            <input type="date" name="date_enregistrement">            
            <label>N° de Sécurité Sociale:</label>
            <input type="number" name="num_secu">
            <label>Mutuelle:</label>
            <input type="text" name="mutuelle">
            <label>Identifiant Médecin Référent:</label>
            <input type="number" name="id_doc">
            <!-- Adresse Principale -->
            <h2>Adresse</h2>
            <label>Adresse:</label>
            <input type="text" name="adresse">
            <label>Code Postal:</label>
            <input type="text" name="code_postal">
            <label>Ville:</label>
            <input type="text" name="ville">
            <button type="submit" name="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>