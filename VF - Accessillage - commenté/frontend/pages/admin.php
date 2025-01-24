<?php
require '../../backend/config/config.php'; 
require '../../backend/routes/docteurRoutes.php';
require '../../backend/routes/userRoutes.php';

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
    <!-- Formulaire d'ajout d'un docteur -->
    <form method="POST">
         <div class="container">
            <div class="section-card">
                <h1>Administration</h1>                     
                <h2>Gestion des Docteurs</h2>
                     <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>

                    <label for="service">Service :</label>
                    <input type="text" id="service" name="service" required>

                    <input type="hidden" name="action" value="add_doc">
                    <input type="submit" name="add_doc" value="Ajouter">
            </div>
        </div>
    </form>

    <!-- Formulaire de mise à jour d'un docteur -->
    <form method="POST">
        <div class="container">
            <div class="section-card">
                <label for="id">ID du Docteur à mettre à jour :</label>
                <input type="number" id="id_doc" name="id_doc" required>
                
                <label for="nom">Nouveau Nom :</label>
                <input type="text" id="nom" name="nom">

                <label for="prenom">Nouveau Prénom :</label>
                <input type="text" id="prenom" name="prenom" >
                
                <label for="service">Nouveau Service :</label>
                <input type="text" id="service" name="service">
                
                <input type="hidden" name="action" value="update_doc">
                <input type="submit" name="update_doc" value="Mettre à Jour">
            </div>
        </div>
    </form>

    <!-- Formulaire de suppression d'un docteur -->
    <form method="POST">
        <div class="container">
            <div class="section-card">
                <label for="id">ID du Docteur à supprimer :</label>
                <input type="number" id="id_doc" name="id_doc" required>

                <input type="hidden" name="action" value="delete_doc">
                <input type="submit" name="delete_doc" value="Supprimer">
            </div>
        </div>
    </form>

    <!-- Formulaire d'ajout d'un utilisateur -->
    <form method="POST">
        <div class="container">
            <div class="section-card">
                <h2>Gestion des Utilisateurs</h2>
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

                <input type="hidden" name="action" value="add_user">
                <input type="submit" name="add" value="Ajouter un Utilisateur">
            </div>
        </div>
    </form>

    <!-- Formulaire de mise à jour d'un utilisateur -->
    <form method="POST">
        <div class="container">
            <div class="section-card">
                <label for="id">ID de l'Utilisateur à mettre à jour :</label>
                <input type="number" id="id_users" name="id_users" required>

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

                <input type="hidden" name="action" value="update_user">
                <input type="submit" name="update_user" value="Mettre à Jour">
            </div>
        </div>
    </form>

    <!-- Formulaire de suppression d'un utilisateur -->
    <form method="POST">
        <div class="container">
            <div class="section-card">
                <label for="id">ID de l'Utilisateur à supprimer :</label>
                <input type="number" id="id_users" name="id_users" required>

                <input type="hidden" name="action" value="delete_user">
                <input type="submit" name="delete_user" value="Supprimer">
            </div>
        </div>
    </form>

</body>
</html>
