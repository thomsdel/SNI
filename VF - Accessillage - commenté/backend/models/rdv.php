<?php
require_once __DIR__ . '/../config/config.php';

class Rdv {
    private $pdo;

    // Constructeur pour initialiser la connexion PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour créer un nouveau rendez-vous
    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO rdv (id_doc, id_patient, titre, duree, id_presc, date_rdv, heure, secteur) VALUES (:id_doc, :id_patient, :titre, :duree, :id_presc, :date_rdv, :heure, :secteur)");
        
        // Exécute l'insertion avec les données fournies
        return $stmt->execute([
            ':id_doc' => $data['id_doc'],
            ':id_patient' => $data['id_patient'],
            ':titre' => $data['titre'],
            ':duree' => $data['duree'],
            ':id_presc' => $data['id_presc'],
            ':date_rdv' => $data['date_rdv'],
            ':heure' => $data['heure'],
            ':secteur' => $data['secteur'],
        ]);
    }

    // Méthode pour trouver un rendez-vous par son ID
    public function findById($id_rdv) {
        $stmt = $this->pdo->prepare("SELECT * FROM rdv WHERE id_rdv = :id_rdv");
        $stmt->bindParam(':id_rdv', $id_rdv);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour les informations d'un rendez-vous
    public function update($id_rdv, $data) {
        $stmt = $this->pdo->prepare("UPDATE rdv SET id_doc = :id_doc, id_patient = :id_patient, titre = :titre, duree = :duree, id_presc = :id_presc, date_rdv = :date_rdv, heure = :heure, secteur = :secteur WHERE id_rdv = :id_rdv");
        
        // Ajoute l'ID du rendez-vous aux données et exécute la mise à jour
        $data[':id_rdv'] = $id_rdv;
        return $stmt->execute([
            ':id_doc' => $data['id_doc'],
            ':id_patient' => $data['id_patient'],
            ':titre' => $data['titre'],
            ':duree' => $data['duree'],
            ':id_presc' => $data['id_presc'],
            ':date_rdv' => $data['date_rdv'],
            ':heure' => $data['heure'],
            ':secteur' => $data['secteur'],
            ':id_rdv' => $id_rdv
        ]);
    }

    // Méthode pour supprimer un rendez-vous
    public function delete($id_rdv) {
        $stmt = $this->pdo->prepare("DELETE FROM rdv WHERE id_rdv = :id_rdv");
        return $stmt->execute([':id_rdv' => $id_rdv]);
    }

    // Méthode pour trouver tous les rendez-vous d'un médecin par son ID
    public function findByDoctorId($id_doc) {
        $stmt = $this->pdo->prepare("SELECT * FROM rdv WHERE id_doc = :id_doc");
        $stmt->bindParam(':id_doc', $id_doc);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour trouver tous les rendez-vous d'un patient par son ID
    public function findByPatientId($id_patient) {
        $stmt = $this->pdo->prepare("SELECT * FROM rdv WHERE id_patient = :id_patient");
        $stmt->bindParam(':id_patient', $id_patient);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
