<?php
require_once '../controllers/RdvController.php';
// require '../config/config.php';

// Création du contrôleur des Rdv
$rdvController = new RdvController($pdo);

// Ajout d'un rendez-vous
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $rdvData = [
            'id_doc' => $_POST['id_doc'] ?? null,
            'id_patient' => $_POST['id_patient'] ?? null,
            'titre' => $_POST['titre'] ?? '',
            'duree' => $_POST['duree'] ?? '',
            'id_presc' => $_POST['id_presc'] ?? null,
            'date_rdv' => $_POST['date_rdv'] ?? '',
            'heure' => $_POST['heure'] ?? '',
            'secteur' => $_POST['secteur'] ?? ''
        ];
        print_r($rdvData); // Vérifiez les valeurs ici

        // Appeler la fonction pour ajouter le rendez-vous
        $rdvController->addRdv($rdvData);
    }

    // Modifier un rendez-vous
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $idRdv = $_POST['id_rdv'];
        $rdvData = [
            'id_doc' => $_POST['id_doc'] ?? null,
            'id_patient' => $_POST['id_patient'] ?? null,
            'titre' => $_POST['titre'] ?? '',
            'duree' => $_POST['duree'] ?? '',
            'id_presc' => $_POST['id_presc'] ?? null,
            'date_rdv' => $_POST['date_rdv'] ?? '',
            'heure' => $_POST['heure'] ?? '',
            'secteur' => $_POST['secteur'] ?? ''
        ];
        $rdvController->updateRdv($idRdv, $rdvData);
    }

    // Obtenir un rendez-vous
    if (isset($_POST['id_rdv']) && isset($_POST['action']) && $_POST['action'] === 'get') {
        $rdv = $rdvController->getRdv($_POST['id_rdv']);
        echo json_encode($rdv);  // Afficher la réponse JSON
    }

    // Supprimer un rendez-vous
    if (isset($_POST['id_rdv']) && isset($_POST['action']) && $_POST['action'] === 'delete') {
        $rdv = $rdvController->deleteRdv($_POST['id_rdv']);
    }
}
?>