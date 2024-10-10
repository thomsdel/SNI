<?php
require_once __DIR__ . '/../config/config.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($email, $password, $nom, $prenom, $tel) {
        $stmt = $this->pdo->prepare("INSERT INTO users (email_users, password, nom_users, prenom_users, tel_users) VALUES (:email, :password, :nom, :prenom, :tel)");
        
        return $stmt->execute([
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':tel' => $tel
        ]);
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email_users = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_users, $data) {
        $stmt = $this->pdo->prepare("UPDATE users SET email_users = :email, nom_users = :nom, prenom_users = :prenom, tel_users = :tel WHERE id_users = :id_users");
        $data[':id_users'] = $id_users; // Ajoute l'ID à la liste des données
        return $stmt->execute($data);
    }

    public function delete($id_users) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id_users = :id_users");
        return $stmt->execute([':id_users' => $id_users]);
    }

    // Ajoute d'autres méthodes si nécessaire...
}
?>
