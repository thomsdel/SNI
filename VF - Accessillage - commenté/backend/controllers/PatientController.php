<?php
// Inclusion du modèle "Patient"
require_once __DIR__ . '/../models/patient.php';

class PatientController {
    private $patientModel; // Instance du modèle Patient

    // Initialise le contrôleur avec une connexion à la base de données via PDO
    public function __construct($pdo) {
        $this->patientModel = new Patient($pdo);
    }

    // Ajoute un nouveau patient en utilisant les données fournies
    public function addPatient($data) {
        return $this->patientModel->create($data);
    }

    // Récupère les patients actuellement admis
    public function getPatientsAdmis() {
        return $this->patientModel->isAdmis();
    }

    // Récupère les informations d'un patient spécifique à partir de son ID
    public function getPatient($id_patient) {
        return $this->patientModel->findById($id_patient);
    }

    // Récupère la liste de tous les patients
    public function getAllPatients() {
        return $this->patientModel->getAll();
    }    

    // Met à jour les informations d'un patient existant
    public function updatePatient($id_patient, $data) {
        return $this->patientModel->update($id_patient, $data);
    }

    // Supprime un patient à partir de son ID
    public function deletePatient($id_patient) {
        return $this->patientModel->delete($id_patient);
    }
}
?>
