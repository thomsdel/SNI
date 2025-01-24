<?php
// Inclusion du modèle "Docteur" pour interagir avec la base de données
require_once __DIR__ . '/../models/docteur.php';

class DocteurController {
    private $docteurModel; // Instance du modèle Docteur

    // Constructeur : initialise le modèle Docteur avec l'objet PDO pour la connexion à la base de données
    public function __construct($pdo) {
        $this->docteurModel = new Docteur($pdo);
    }

    // Ajoute un nouveau docteur en utilisant le modèle
    public function addDocteur($nom, $prenom, $service) {
        return $this->docteurModel->create($nom, $prenom, $service);
    }

    // Récupère les informations d'un docteur par son ID
    public function getDocteur($id_doc) {
        return $this->docteurModel->findById($id_doc);
    }

    // Met à jour les informations d'un docteur (par ID et nouvelles données)
    public function updateDocteur($id_doc, $data) {
        return $this->docteurModel->update($id_doc, $data);
    }

    // Supprime un docteur de la base de données par son ID
    public function deleteDocteur($id_doc) {
        return $this->docteurModel->delete($id_doc);
    }
}
?>
