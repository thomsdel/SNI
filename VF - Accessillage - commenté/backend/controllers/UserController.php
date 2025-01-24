<?php
// Inclusion du modèle "User"
require_once __DIR__ . '/../models/users.php';

class UserController {
    private $userModel; // Instance du modèle User

    // Initialise le contrôleur avec une connexion PDO
    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Ajoute un nouvel utilisateur avec les informations fournies
    public function addUser($email, $password, $nom, $prenom, $tel) {
        return $this->userModel->create($email, $password, $nom, $prenom, $tel);
    }

    // Authentifie un utilisateur en vérifiant son email et son mot de passe
    public function loginUser($email, $password) {
        $user = $this->userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie
            return $user;
        }
        return false; // Si l'authentification échoue, retourne false
    }

    // Met à jour les informations d'un utilisateur avec les données fournies
    public function updateUser($id_users, $data) {
        return $this->userModel->update($id_users, $data);
    }

    // Supprime un utilisateur par son ID
    public function deleteUser($id_users) {
        return $this->userModel->delete($id_users);
    }
}
?>
