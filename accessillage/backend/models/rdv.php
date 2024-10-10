<?php
require_once __DIR__ . '/../config/config.php';

class Rdv {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($id_doc, $num_secu, $duree) {
        $stmt = $this->pdo->prepare("INSERT INTO rdv (id_doc, num_secu, duree) VALUES (:id_doc, :num_secu, :duree)");
        
        return $stmt->execute([
            ':id_doc' => $id_doc,
            ':num_secu' => $num_secu,
            ':duree' => $duree
        ]);
    }

    public function findById($id_rdv) {
        $stmt = $this->pdo->prepare("SELECT * FROM rdv WHERE id_rdv = :id_rdv");
        $stmt->bindParam(':id_rdv', $id_rdv);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_rdv, $data) {
        $stmt = $this->pdo->prepare("UPDATE rdv SET id_doc = :id_doc, num_secu = :num_secu, duree = :duree WHERE id_rdv = :id_rdv");
        $data[':id_rdv'] = $id_rdv; // Ajoute l'ID à la liste des données
        return $stmt->execute($data);
    }

    public function delete($id_rdv) {
        $stmt = $this->pdo->prepare("DELETE FROM rdv WHERE id_rdv = :id_rdv");
        return $stmt->execute([':id_rdv' => $id_rdv]);
    }

    // Ajoute d'autres méthodes si nécessaire...
}
?>
