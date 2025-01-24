<?php
require_once __DIR__ . '/../config/config.php';

class MedicamentModel {
    private $pdo;

    // Constructeur pour initialiser la connexion PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter un médicament
    public function create($medicament) {
        $stmt = $this->pdo->prepare("INSERT INTO medicament (medicament) VALUES (:medicament)");
        $stmt->bindParam(':medicament', $medicament);
        return $stmt->execute();
    }

    // Méthode pour récupérer tous les médicaments
    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM medicament");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour chercher un médicament par nom
    public function search($medicament) {
        $stmt = $this->pdo->prepare("SELECT * FROM medicament WHERE medicament LIKE :medicament");
        $stmt->bindValue(':medicament', "%$medicament%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Méthode pour mettre à jour un médicament
    public function update($id, $medicament) {
        $stmt = $this->pdo->prepare("UPDATE medicament SET medicament = :medicament WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':medicament', $medicament);
        return $stmt->execute();
    }

    // Méthode pour supprimer un médicament
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM medicament WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
