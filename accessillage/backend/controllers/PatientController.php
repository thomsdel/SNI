<?php
require_once __DIR__ . '/../models/patient.php';

class PatientController {
    private $patientModel;

    public function __construct($pdo) {
        $this->patientModel = new Patient($pdo);
    }

    public function addPatient($data) {
        return $this->patientModel->create($data);
    }

    public function getPatient($id_patient) {
        return $this->patientModel->findById($id_patient);
    }

    public function getAllPatients() {
        return $this->patientModel->getAll(); // Appelle la méthode dans le modèle
    }    

    public function updatePatient($id_patient, $data) {
        return $this->patientModel->update($id_patient, $data);
    }

    public function deletePatient($id_patient) {
        return $this->patientModel->delete($id_patient);
    }
}
?>
