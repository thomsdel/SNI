<?php
require_once __DIR__ . '/../models/docteur.php';

class DocteurController {
    private $docteurModel;

    public function __construct($pdo) {
        $this->docteurModel = new Docteur($pdo);
    }

    public function addDocteur($nom, $prenom, $service) {
        return $this->docteurModel->create($nom, $prenom, $service);
    }

    public function getDocteur($id_doc) {
        return $this->docteurModel->findById($id_doc);
    }

    public function updateDocteur($id_doc, $data) {
        return $this->docteurModel->update($id_doc, $data);
    }

    public function deleteDocteur($id_doc) {
        return $this->docteurModel->delete($id_doc);
    }
}
?>
