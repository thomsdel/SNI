<?php
require_once __DIR__ . '/../config/config.php';

class Patient {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO patient (num_secu, civilite, sexe, nom, prenom, nom_usage, date_naissance, lieu_naissance, situation_familiale, profession, enfants, mutuelle, adresse, code_postal, ville, email_patient, tel_patient, id_doc, date_enregistrement) VALUES (:num_secu, :civilite, :sexe, :nom, :prenom, :nom_usage, :date_naissance, :lieu_naissance, :situation_familiale, :profession, :enfants, :mutuelle, :adresse, :code_postal, :ville, :email_patient, :tel_patient, :id_doc, :date_enregistrement)");

        return $stmt->execute([
            ':num_secu' => $data['num_secu'],
            ':civilite' => $data['civilite'],
            ':sexe' => $data['sexe'],
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':nom_usage' => $data['nom_usage'],
            ':date_naissance' => $data['date_naissance'],
            ':lieu_naissance' => $data['lieu_naissance'],
            ':situation_familiale' => $data['situation_familiale'],
            ':profession' => $data['profession'],
            ':enfants' => $data['enfants'],
            ':mutuelle' => $data['mutuelle'],
            ':adresse' => $data['adresse'],
            ':code_postal' => $data['code_postal'],
            ':ville' => $data['ville'],
            ':email_patient' => $data['email_patient'],
            ':tel_patient' => $data['tel_patient'],
            ':id_doc' => $data['id_doc'],
            ':date_enregistrement' => $data['date_enregistrement'],
        ]);
    }

    public function findById($id_patient) {
        $stmt = $this->pdo->prepare("SELECT * FROM patient WHERE id_patient = :id_patient");
        $stmt->bindParam(':id_patient', $id_patient);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM patient");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les résultats
    }

    public function update($id_patient, $data) {
        $stmt = $this->pdo->prepare("UPDATE patient SET num_secu = :num_secu, civilite = :civilite, sexe = :sexe, nom = :nom, prenom = :prenom, nom_usage = :nom_usage, date_naissance = :date_naissance, lieu_naissance = :lieu_naissance, situation_familiale = :situation_familiale, profession = :profession, enfants = :enfants, mutuelle = :mutuelle, adresse = :adresse, code_postal = :code_postal, ville = :ville, email_patient = :email_patient, tel_patient = :tel_patient, id_doc = :id_doc, date_enregistrement = :date_enregistrement WHERE id_patient = :id_patient");
        
        $data[':id_patient'] = $id_patient; // Ajoute l'ID à la liste des données
        return $stmt->execute($data);
    }

    public function delete($id_patient) {
        $stmt = $this->pdo->prepare("DELETE FROM patient WHERE id_patient = :id_patient");
        $stmt->bindParam(':id_patient', $id_patient);
        return $stmt->execute();
    }
}
?>
