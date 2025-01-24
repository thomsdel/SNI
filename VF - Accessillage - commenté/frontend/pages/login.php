<?php
require '../../backend/config/config.php'; 
require '../../backend/routes/userRoutes.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/styles/styles.css"> 
</head>
<body>
    <div class="container">
        <!-- Titre de la page -->
        <div class="section-card">
            <div class="row">
                <h1>Bienvenue sur Accessillage</h1>
            </div>
            <div class="row">
                <h2>Veuillez vous connecter</h2> 
            </div>
        </div>
    </div>

        <!-- Formulaire de connexion -->
    <form method="POST">
        <div class="container">
            <div class="section-card">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <input type="hidden" name="action" value="login">
                <input type="submit" name="login" value="Se connecter">
            </div>
        </div>
    </form>
</body>
</html>
