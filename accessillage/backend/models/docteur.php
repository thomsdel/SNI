<?php
require_once __DIR__ . '/../config/config.php';

class Docteur {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($nom, $prenom, $service) {
        $stmt = $this->pdo->prepare("INSERT INTO docteur (nom_doc, prenom_doc, service) VALUES (:nom, :prenom, :service)");
        
        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':service' => $service
        ]);
    }

    public function findById($id_doc) {
        $stmt = $this->pdo->prepare("SELECT * FROM docteur WHERE id_doc = :id_doc");
        $stmt->bindParam(':id_doc', $id_doc);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_doc, $data) {
        $stmt = $this->pdo->prepare("UPDATE docteur SET nom_doc = :nom, prenom_doc = :prenom, service = :service WHERE id_doc = :id_doc");
        $data[':id_doc'] = $id_doc; // Ajoute l'ID à la liste des données
        return $stmt->execute($data);
    }

    public function delete($id_doc) {
        $stmt = $this->pdo->prepare("DELETE FROM docteur WHERE id_doc = :id_doc");
        return $stmt->execute([':id_doc' => $id_doc]);
    }

    // Ajoute d'autres méthodes si nécessaire...
}
?>
