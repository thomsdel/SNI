<?php
require_once __DIR__ . '/../models/prescription.php';

class PrescriptionController {
    private $prescriptionModel;

    public function __construct($pdo) {
        $this->prescriptionModel = new Prescription($pdo);
    }

    public function addPrescription($medicament, $frequence, $duree_presc) {
        return $this->prescriptionModel->create($medicament, $frequence, $duree_presc);
    }

    public function getPrescription($id_presc) {
        return $this->prescriptionModel->findById($id_presc);
    }

    public function updatePrescription($id_presc, $data) {
        return $this->prescriptionModel->update($id_presc, $data);
    }

    public function deletePrescription($id_presc) {
        return $this->prescriptionModel->delete($id_presc);
    }
}
?>
