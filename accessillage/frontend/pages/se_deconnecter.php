<?php
// Inclure le fichier de session
require '../../backend/sessions/session.php';

// Déconnexion de l'utilisateur
logoutUser();

// Rediriger vers la page de connexion ou d'accueil après déconnexion
header("Location: ../page_connexion/login.php");
exit();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se déconnecter</title>
    <link rel="stylesheet" href="../../assets/styles/styles.css">
</head>
<body>
    <header>
        <h1>Se déconnecter</h1>
    </header>
    <main>
        <section class="logout-section">
            <h2>Vous avez été déconnecté avec succès.</h2>
            <p>Merci de votre visite. À bientôt !</p>
            <button onclick="window.location.href='../page_connexion/login.php'">Retour à la page d'accueil</button>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Hôpital. Tous droits réservés.</p>
    </footer>
    <script src="../../assets/script/navbar.js"></script>
</body>
</html>
