<?php
// Inclusion du modèle "Rdv" (Rendez-vous)
require_once __DIR__ . '/../models/rdv.php';

class RdvController {
    private $rdvModel; // Instance du modèle Rdv

    // Initialise le contrôleur avec une connexion PDO
    public function __construct($pdo) {
        $this->rdvModel = new Rdv($pdo);
    }

    // Ajoute un nouveau rendez-vous
    public function addRdv($data) {
        return $this->rdvModel->create($data);
    }

    // Récupère les détails d'un rendez-vous spécifique à partir de son ID
    public function getRdv($id_rdv) {
        return $this->rdvModel->findById($id_rdv);
    }

    // Met à jour les informations d'un rendez-vous existant
    public function updateRdv($id_rdv, $data) {
        return $this->rdvModel->update($id_rdv, $data);
    }

    // Supprime un rendez-vous à partir de son ID
    public function deleteRdv($id_rdv) {
        return $this->rdvModel->delete($id_rdv);
    }

    // Récupère les rendez-vous liés à un docteur spécifique
    public function getRdvByDoctor($id_doc) {
        $stmt = $this->rdvModel->findByDoctorId($id_doc);
        return $stmt; 
    }

    // Récupère les rendez-vous liés à un patient spécifique
    public function getRdvByPatient($id_patient) {
        $stmt = $this->rdvModel->findByPatientId($id_patient);
        return $stmt; 
    }
}
?>
