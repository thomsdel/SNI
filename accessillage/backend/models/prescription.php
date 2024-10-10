<?php
require_once __DIR__ . '/../config/config.php';

class Prescription {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($medicament, $frequence, $duree_presc) {
        $stmt = $this->pdo->prepare("INSERT INTO prescription (medicament, frequence, duree_presc) VALUES (:medicament, :frequence, :duree_presc)");
        
        return $stmt->execute([
            ':medicament' => $medicament,
            ':frequence' => $frequence,
            ':duree_presc' => $duree_presc
        ]);
    }

    public function findById($id_presc) {
        $stmt = $this->pdo->prepare("SELECT * FROM prescription WHERE id_presc = :id_presc");
        $stmt->bindParam(':id_presc', $id_presc);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_presc, $data) {
        $stmt = $this->pdo->prepare("UPDATE prescription SET medicament = :medicament, frequence = :frequence, duree_presc = :duree_presc WHERE id_presc = :id_presc");
        $data[':id_presc'] = $id_presc; // Ajoute l'ID à la liste des données
        return $stmt->execute($data);
    }

    public function delete($id_presc) {
        $stmt = $this->pdo->prepare("DELETE FROM prescription WHERE id_presc = :id_presc");
        return $stmt->execute([':id_presc' => $id_presc]);
    }

    // Ajoute d'autres méthodes si nécessaire...
}
?>
