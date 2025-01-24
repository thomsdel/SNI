<?php
require '../../backend/config/config.php'; 
require '../../backend/controllers/PatientController.php'; 

// Inclusion des composants de navigation et des onglets
require '../components/navbar.php';
require '../components/onglet.php';

// Gestion du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Récupérer les valeurs du formulaire
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
        $patientController = new PatientController($pdo);
        $result = $patientController->addPatient($patientData);
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
<form method="post">
    <div class="container">
        <div class="column">
            <!-- État Civil -->
            <div class="section-card" aria-labelledby="etat-civil-title">
                <h2 id="etat-civil-title">État Civil</h2>
                <div class="row">
                    <label for="civilite">Civilité :</label>
                    <div>
                        <input type="checkbox" id="civilite" name="civilite"unchecked />
                        <label for="civilite">Sans</label>
                    </div>
                    <div>
                        <input type="checkbox" id="civilite" name="civilite" unchecked />
                        <label for="civilite">Mme</label>
                    </div>
                    <div>
                        <input type="checkbox" id="civilite" name="civilite" unchecked />
                        <label for="civilite">Mlle</label>
                    </div>
                    <div>
                        <input type="checkbox" id="civilite" name="civilite" unchecked />
                        <label for="civilite">Mr</label>
                    </div>
                </div>
                <div class="row">
                    <label for="sexe">Sexe :</label>
                    <div>
                        <input type="checkbox" id="sexe" name="sexe" unchecked />
                        <label for="sexe">Masculin</label>
                    </div>
                    <div>
                        <input type="checkbox" id="sexe" name="sexe" unchecked />
                        <label for="sexe">Féminin</label>
                    </div>
                    <div>
                        <input type="checkbox" id="sexe" name="sexe" unchecked />
                        <label for="sexe">Autre</label>
                    </div>
                </div>
                <div class="row">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom">
                </div>
                <div class="row">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom">
                </div>
                <div class="row">
                    <label for="date_naissance">Date de Naissance :</label>
                    <input type="date" name="date_naissance" id="date_naissance">
                </div>
                <div class="row">
                    <label for="lieu_naissance">Lieu de Naissance :</label>
                    <input type="text" name="lieu_naissance" id="lieu_naissance">
                </div>
                <div class="row">
                    <label for="nom_usage">Nom de Jeune Fille :</label>
                    <input type="text" name="nom_usage" id="nom_usage">
                </div>
                <div class="row">
                    <label for="situation_familiale">Situation Familiale :</label>
                    <input type="text" name="situation_familiale" id="situation_familiale">
                </div>
                <div class="row">
                    <label for="enfants">Nombre d'enfants :</label>
                    <input type="number" name="enfants" id="enfants">
                </div>
                <div class="row">
                    <label for="profession">Profession :</label>
                    <input type="text" name="profession" id="profession">
                </div>
            </div>

            <!-- Situation Administrative -->
            <div class="section-card" aria-labelledby="situation-administrative">
                <h2 id="situation-administrative">Situation Administrative</h2>
                <div class="row">
                    <label for="date_enregistrement">Date enregistrement :</label>
                    <input type="date" name="date_enregistrement" id="date_enregistrement">
                </div>
                <div class="row">
                    <label for="num_secu">N° Sécurité Sociale :</label>
                    <input type="number" name="num_secu" id="num_secu">
                </div>
                <div class="row">
                    <label for="mutuelle">Mutuelle :</label>
                    <input type="text" name="mutuelle" id="mutuelle">
                </div>
                <div class="row">
                    <label for="id_doc">Identifiant Médecin Référent :</label>
                    <input type="number" name="id_doc" id="id_doc" required>
                </div>
            </div>
        </div>

        <div class="column">
            <!-- Téléphone et eMail -->
            <div class="section-card" aria-labelledby="telephone-email">
                <h2 id="telephone-email">Téléphone & Email</h2>
                <div class="row">
                    <label for="tel_patient">Portable :</label>
                    <input type="text" name="tel_patient" id="tel_patient">
                </div>
                <div class="row">
                    <label for="email_patient">eMail :</label>
                    <input type="email" name="email_patient" id="email_patient">
                </div>
                <div class="row">
                    <label for="fixe">Fixe :</label>
                    <input type="text" name="fixe" id="fixe">
                </div>
                <div class="row">
                    <label for="contact_urgence">Numéro à contacter en cas d'urgence :</label>
                    <input type="text" name="contact_urgence" id="contact_urgence">
                </div>
            </div>

            <!-- Divers -->
            <div class="section-card" aria-labelledby="divers">
                <h2 id="divers">Divers</h2>
                <div class="row">
                    <label for="num_dossier">Numéro dossier :</label>
                    <input type="number" name="num_dossier" id="num_dossier">
                </div>
                <div class="row">
                    <label for="groupe_patient">Groupe patient :</label>
                    <input type="text" name="groupe_patient" id="groupe_patient">
                </div>
                <div class="row">
                    <label for="groupe_famille">Groupe famille :</label>
                    <input type="text" name="groupe_famille" id="groupe_famille">
                </div>
                <div class="row">
                    <label for="remarques">Remarques :</label>
                    <input type="text" name="remarques" id="remarques">
                </div>
            </div>

            <!-- Adresse -->
            <div class="section-card" aria-labelledby="adresse">
                <h2 id="adresse">Adresse</h2>
                <div class="row">
                    <label for="adresse">Adresse :</label>
                    <input type="text" name="adresse" id="adresse">
                </div>
                <div class="row">
                    <label for="code_postal">Code Postal :</label>
                    <input type="text" name="code_postal" id="code_postal">
                </div>
                <div class="row">
                    <label for="ville">Ville :</label>
                    <input type="text" name="ville" id="ville">
                </div>
            </div>

        </div>
        <button type="submit" name="submit"><img src="../assets/images/enregistrer.png" alt="enregistrer"></button>
    </div>
    </form>
</body>
</html>


