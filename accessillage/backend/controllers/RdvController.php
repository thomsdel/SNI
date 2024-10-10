<?php
require_once __DIR__ . '/../models/rdv.php';

class RdvController {
    private $rdvModel;

    public function __construct($pdo) {
        $this->rdvModel = new Rdv($pdo);
    }

    public function addRdv($id_doc, $num_secu, $duree) {
        return $this->rdvModel->create($id_doc, $num_secu, $duree);
    }

    public function getRdv($id_rdv) {
        return $this->rdvModel->findById($id_rdv);
    }

    public function updateRdv($id_rdv, $data) {
        return $this->rdvModel->update($id_rdv, $data);
    }

    public function deleteRdv($id_rdv) {
        return $this->rdvModel->delete($id_rdv);
    }

    public function getRdvByDoctor($id_doc) {
        $stmt = $this->rdvModel->findByDoctorId($id_doc);
        return $stmt; 
    }

    public function getRdvByPatient($num_secu) {
        $stmt = $this->rdvModel->findByPatientNumSecu($num_secu);
        return $stmt; 
    }
}
?>
