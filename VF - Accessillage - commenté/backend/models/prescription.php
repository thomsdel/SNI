<?php
require_once __DIR__ . '/../config/config.php';

class Prescription {
    private $pdo;

    // Constructeur pour initialiser la connexion PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour créer une prescription
    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO prescription (medicament, duree_presc, id_patient, date_presc, dose, voie) VALUES (:medicament, :duree_presc, :id_patient, :date_presc, :dose, :voie)");
        
        // Exécute l'insertion avec les données fournies
        return $stmt->execute([
            ':medicament' => $data['medicament'],
            ':duree_presc' => $data['duree_presc'],
            ':id_patient' => $data['id_patient'],
            ':date_presc' => $data['date_presc'],
            ':dose' => $data['dose'],
            ':voie' => $data['voie'],
        ]);
    }
    

    // Méthode pour trouver une prescription par son ID
    public function findById($id_presc) {
        $stmt = $this->pdo->prepare("SELECT * FROM prescription WHERE id_presc = :id_presc");
        $stmt->bindParam(':id_presc', $id_presc);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour une prescription
    public function update($id_presc, $data) {
        // Mise à jour des informations de base de la prescription
        $sql = "UPDATE prescription SET medicament = :medicament, frequence = :frequence, duree_presc = :duree_presc WHERE id_presc = :id_presc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':medicament', $data['medicament']);
        $stmt->bindParam(':frequence', $data['frequence']);
        $stmt->bindParam(':duree_presc', $data['duree_presc']);
        $stmt->bindParam(':id_presc', $id_presc);
        $stmt->execute();
    
        // Supprime les anciens médicaments associés à la prescription
        $sql2 = "DELETE FROM prescription_medicament WHERE id_presc = :id_presc";
        $stmt2 = $this->pdo->prepare($sql2);
        $stmt2->bindParam(':id_presc', $id_presc);
        $stmt2->execute();
    
        // Ajoute les nouveaux médicaments associés à la prescription
        foreach ($data['medicament'] as $med) {
            $sql3 = "INSERT INTO prescription_medicament (id_presc, id_medicament) VALUES (:id_presc, :id_medicament)";
            $stmt3 = $this->pdo->prepare($sql3);
            $stmt3->bindParam(':id_presc', $id_presc);
            $stmt3->bindParam(':id_medicament', $med);
            $stmt3->execute();
        }
    }    


    // Méthode pour supprimer une prescription et ses médicaments associés
    public function delete($id_presc) {
        // Supprime les médicaments associés à la prescription
        $sql1 = "DELETE FROM prescription_medicament WHERE id_presc = :id_presc";
        $stmt1 = $this->pdo->prepare($sql1);
        $stmt1->bindParam(':id_presc', $id_presc);
        $stmt1->execute();
    
        // Supprime la prescription elle-même
        $sql2 = "DELETE FROM prescription WHERE id_presc = :id_presc";
        $stmt2 = $this->pdo->prepare($sql2);
        $stmt2->bindParam(':id_presc', $id_presc);
        $stmt2->execute();
    }    

    // Méthode pour récupérer toutes les prescriptions d'un patient
    public function getPrescriptionsByPatient($id_patient) {
        $stmt = $this->pdo->prepare("SELECT medicament, date_presc, voie FROM prescription WHERE id_patient = :id_patient");
        $stmt->execute([':id_patient' => $id_patient]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
