<?php
require_once __DIR__ . '/../config/config.php';

class Rdv {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO rdv (titre_rdv, id_doc, id_patient, secteur, date_debut, duree, remarques) VALUES (:titre_rdv, :id_doc, :id_patient, :secteur, :date_debut, :duree, :remarques)");
        
        return $stmt->execute([
            ':titre_rdv' => $data['titre_rdv'],
            ':id_doc' => $data['id_doc'],
            ':id_patient' => $data['id_patient'],
            ':secteur' => $data['secteur'],
            ':date_debut' => $data['date_debut'],
            ':duree' => $data['duree'],
            ':remarques' => $data['remarques'],
        ]);
    }

    public function findById($id_rdv) {
        $stmt = $this->pdo->prepare("SELECT * FROM rdv WHERE id_rdv = :id_rdv");
        $stmt->bindParam(':id_rdv', $id_rdv);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_rdv, $data) {
        $stmt = $this->pdo->prepare("UPDATE rdv SET titre_rdv = :titre_rdv, id_doc = :id_doc, id_patient = :id_patient, secteur = :secteur, date_debut = :date_debut, duree = :duree, remarques = :remarques WHERE id_rdv = :id_rdv");
        
        $data[':id_rdv'] = $id_rdv; // Ajoute l'ID à la liste des données
        return $stmt->execute([
            ':titre_rdv' => $data['titre_rdv'],
            ':id_doc' => $data['id_doc'],
            ':id_patient' => $data['id_patient'],
            ':secteur' => $data['secteur'],
            ':date_debut' => $data['date_debut'],
            ':duree' => $data['duree'],
            ':remarques' => $data['remarques'],
            ':id_rdv' => $id_rdv
        ]);
    }

    public function delete($id_rdv) {
        $stmt = $this->pdo->prepare("DELETE FROM rdv WHERE id_rdv = :id_rdv");
        return $stmt->execute([':id_rdv' => $id_rdv]);
    }

    public function findByDoctorId($id_doc) {
        $stmt = $this->pdo->prepare("SELECT * FROM rdv WHERE id_doc = :id_doc");
        $stmt->bindParam(':id_doc', $id_doc);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByPatientId($id_patient) {
        $stmt = $this->pdo->prepare("SELECT * FROM rdv WHERE id_patient = :id_patient");
        $stmt->bindParam(':id_patient', $id_patient);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
