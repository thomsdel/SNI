<?php
require_once '../controllers/RdvController.php';
// require '../config/config.php';

$rdvController = new RdvController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $rdvData = [
            'titre_rdv' => $_POST['titre_rdv'],
            'id_doc' => $_POST['id_doc'],
            'id_patient' => $_POST['id_patient'],
            'secteur' => $_POST['secteur'],
            'date_debut' => $_POST['date_debut'],
            'duree' => $_POST['duree'],
            'remarques' => $_POST['remarques'],
        ];
        // Appeler la fonction pour ajouter le rendez-vous
        $rdvController->addRdv($rdvData);
    }

    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $idRdv = $_POST['id_rdv'];
        $rdvData = [
            'titre_rdv' => $_POST['titre_rdv'],
            'id_doc' => $_POST['id_doc'],
            'id_patient' => $_POST['id_patient'],
            'secteur' => $_POST['secteur'],
            'date_debut' => $_POST['date_debut'],
            'duree' => $_POST['duree'],
            'remarques' => $_POST['remarques'],
        ];
        // Appeler la fonction pour ajouter le rendez-vous
        $rdvController->updateRdv($idRdv, $rdvData);
    }

    if (isset($_POST['id_rdv']) && isset($_POST['action']) && $_POST['action'] === 'get') {
        $rdv = $rdvController->getRdv($_POST['id_rdv']);
        echo json_encode($rdv);  // Afficher la réponse JSON
    }

    if (isset($_POST['id_rdv']) && isset($_POST['action']) && $_POST['action'] === 'delete') {
        $rdv = $rdvController->deleteRdv($_POST['id_rdv']);
    }
}
?>