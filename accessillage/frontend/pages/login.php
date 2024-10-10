<?php
require '../../backend/config/config.php'; // Inclure la connexion à la base de données

// Vérifier si le formulaire a été soumis
if (isset($_POST['formsend'])) {
    // Récupérer les valeurs du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparer la requête pour vérifier l'existence de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email_users = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Vérifier si l'utilisateur existe
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            // Stocker des informations dans la session
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];

            // Rediriger vers la page d'accueil des patients
            header("Location: liste_patient.php");
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "L'email utilisé est inconnu.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/styles/styles.css"> <!-- Lien vers la feuille de style CSS existante -->
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur Accessillage</h1> <!-- Message de bienvenue -->
        <h2>Veuillez vous connecter</h2> <!-- Message pour inciter à se connecter -->
        
        <?php
        // Afficher un message d'erreur si présent
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="formsend" value="Se connecter">
        </form>
    </div>
</body>
</html>
