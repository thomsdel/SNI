<?php
require_once '../controllers/PatientController.php'; // Inclure le contrôleur des prescriptions
require '../config/config.php'; // Inclure la connexion à la base de données

$patientController = new PatientController($pdo);

// Route pour ajouter un patient
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $patientData = [
            'num_secu' => $_POST['num_secu'],
            'civilite' => $_POST['civilite'],
            'sexe' => $_POST['sexe'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'nom_usage' => $_POST['nom_usage'],
            'date_naissance' => $_POST['date_naissance'],
            'lieu_naissance' => $_POST['lieu_naissance'],
            'situation_familiale' => $_POST['situation_familiale'],
            'profession' => $_POST['profession'],
            'enfants' => $_POST['enfants'],
            'mutuelle' => $_POST['mutuelle'],
            'adresse' => $_POST['adresse'],
            'code_postal' => $_POST['code_postal'],
            'ville' => $_POST['ville'],
            'email_patient' => $_POST['email_patient'],
            'tel_patient' => $_POST['tel_patient'],
            'id_doc' => $_POST['id_doc'],
            'date_enregistrement' => $_POST['date_enregistrement'],
        ];

        $patientController->addPatient($patientData);
    }
}

// Route pour récupérer un patient
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_patient'])) {
    $id_patient = $_GET['id_patient'];
    $patient = $patientController->getPatient($id_patient);
    // Retourner le patient sous forme de JSON ou le charger dans un formulaire
}

// Route pour mettre à jour un patient
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_patient = $_POST['id_patient'];
    $patientData = [
        'num_secu' => $_POST['num_secu'],
        'civilite' => $_POST['civilite'],
        'sexe' => $_POST['sexe'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'nom_usage' => $_POST['nom_usage'],
        'date_naissance' => $_POST['date_naissance'],
        'lieu_naissance' => $_POST['lieu_naissance'],
        'situation_familiale' => $_POST['situation_familiale'],
        'profession' => $_POST['profession'],
        'enfants' => $_POST['enfants'],
        'mutuelle' => $_POST['mutuelle'],
        'adresse' => $_POST['adresse'],
        'code_postal' => $_POST['code_postal'],
        'ville' => $_POST['ville'],
        'email_patient' => $_POST['email_patient'],
        'tel_patient' => $_POST['tel_patient'],
        'id_doc' => $_POST['id_doc'],
        'date_enregistrement' => $_POST['date_enregistrement'],
    ];
    $patientController->updatePatient($id_patient, $patientData);
}

// Route pour supprimer un patient
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_patient = $_POST['id_patient'];
    $patientController->deletePatient($id_patient);
}

// Route pour récupérer tous les patients
$router->get('/patients', 'PatientController@getAllPatients'); // Route GET pour obtenir tous les patients

?>
