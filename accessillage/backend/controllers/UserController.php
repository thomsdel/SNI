<?php
require_once __DIR__ . '/../models/users.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function addUser($email, $password, $nom, $prenom, $tel) {
        return $this->userModel->create($email, $password, $nom, $prenom, $tel);
    }

    public function loginUser($email, $password) {
        $user = $this->userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie
            return $user; // Retourne l'utilisateur pour les données de session
        }
        return false; // Authentification échouée
    }

    public function updateUser($id_users, $data) {
        return $this->userModel->update($id_users, $data);
    }

    public function deleteUser($id_users) {
        return $this->userModel->delete($id_users);
    }
}
?>
