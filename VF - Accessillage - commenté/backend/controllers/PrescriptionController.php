<?php
// Inclusion du modèle "Prescription"
require_once __DIR__ . '/../models/prescription.php';

class PrescriptionController {
    private $prescriptionModel; // Instance du modèle Prescription

    // Initialise le contrôleur avec une connexion PDO
    public function __construct($pdo) {
        $this->prescriptionModel = new Prescription($pdo);
    }

    // Ajoute une nouvelle prescription
    public function addPrescription($data) {
        return $this->prescriptionModel->create($data);
    }
    
    // Récupère une prescription spécifique par son ID
    public function getPrescription($id_presc) {
        return $this->prescriptionModel->findById($id_presc);
    }

    // Met à jour une prescription existante
    public function updatePrescription($id_presc, $data) {
        return $this->prescriptionModel->update($id_presc, $data);
    }

    // Supprime une prescription par son ID
    public function deletePrescription($id_presc) {
        return $this->prescriptionModel->delete($id_presc);
    }

    // Récupère toutes les prescriptions d'un patient spécifique
    public function getPrescriptions($id_patient) {
        // Vérifie que l'ID patient est valide
        if (!$id_patient || $id_patient <= 0) {
            throw new Exception("ID patient invalide.");
        }

        $prescriptions = $this->prescriptionModel->getPrescriptionsByPatient($id_patient);

        return $prescriptions;
    }
}
?>
