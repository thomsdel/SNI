<?php
require '../../backend/config/config.php'; // Inclure la connexion à la base de données
require '../../backend/controllers/DocteurController.php'; // Inclure le contrôleur des docteurs
require '../../backend/controllers/UserController.php'; // Inclure le contrôleur des utilisateurs

$docteurController = new DocteurController($pdo);
$userController = new UserController($pdo);

$message = "";

// Gestion des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_docteur'])) {
        // Ajouter un docteur
        $result = $docteurController->addDocteur($_POST['nom'], $_POST['prenom'], $_POST['service']);
        echo "<div class='success'>Docteur ajouté avec succès !</div>";
    } elseif (isset($_POST['update_docteur'])) {
        // Mettre à jour un docteur
        $result = $docteurController->updateDocteur($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['service']);
        echo "<div class='success'>Docteur mis à jour avec succès !</div>";
    } elseif (isset($_POST['delete_docteur'])) {
        // Supprimer un docteur
        $result = $docteurController->deleteDocteur($_POST['id']);
        echo "<div class='success'>Docteur supprimé avec succès !</div>";
    } elseif (isset($_POST['add_user'])) {
        // Ajouter un utilisateur
        $result = $userController->addUser($_POST['email'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['tel']);
        echo "<div class='success'>Utilisateur ajouté avec succès !</div>";
    } elseif (isset($_POST['update_user'])) {
        // Mettre à jour un utilisateur
        $result = $userController->updateUser($_POST['id'], $_POST['email'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['tel']);
        echo "<div class='success'>Utilisateur mis à jour avec succès !</div>";
    } elseif (isset($_POST['delete_user'])) {
        // Supprimer un utilisateur
        $result = $userController->deleteUser($_POST['id']);
        echo "<div class='success'>Utilisateur supprimé avec succès !</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
    <div class="container">
        <h1>Administration</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <h2>Gestion des Docteurs</h2>
        <form method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="service">Service :</label>
            <input type="text" id="service" name="service" required>

            <input type="submit" name="add_docteur" value="Ajouter">
        </form>


        <form method="post">
            <label for="id">ID du Docteur à mettre à jour ou supprimer :</label>
            <input type="number" id="id" name="id" required>
            
            <label for="nom">Nouveau Nom :</label>
            <input type="text" id="nom" name="nom">

            <label for="prenom">Nouveau Prénom :</label>
            <input type="text" id="prenom" name="prenom" >
            
            <label for="service">Nouveau Service :</label>
            <input type="text" id="service" name="service">
            
            <input type="submit" name="update_docteur" value="Mettre à Jour">
            <input type="submit" name="delete_docteur" value="Supprimer">
        </form>

        <h2>Gestion des Utilisateurs</h2>
        <form method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="tel">Téléphone :</label>
            <input type="tel" id="tel" name="tel" required>

            <input type="submit" name="add_user" value="Ajouter un Utilisateur">
        </form>

        <form method="post">
            <label for="id">ID de l'Utilisateur à mettre à jour ou supprimer :</label>
            <input type="number" id="id" name="id" required>

            <label for="email">Nouvel Email :</label>
            <input type="email" id="email" name="email">

            <label for="password">Nouveau Mot de passe :</label>
            <input type="password" id="password" name="password">

            <label for="nom">Nouveau Nom :</label>
            <input type="text" id="nom" name="nom">

            <label for="prenom">Nouveau Prénom :</label>
            <input type="text" id="prenom" name="prenom">

            <label for="tel">Nouveau Téléphone :</label>
            <input type="tel" id="tel" name="tel">

            <input type="submit" name="update_user" value="Mettre à Jour">
            <input type="submit" name="delete_user" value="Supprimer">
        </form>
    </div>
</body>
</html>
