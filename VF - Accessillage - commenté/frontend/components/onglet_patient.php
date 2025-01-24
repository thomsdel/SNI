<div class="onglet">

    <!-- Infos patient -->
    <button class="patient-name" onclick="openPatientPopup(<?= htmlspecialchars($patient['id_patient']) ?>)"><?= htmlspecialchars($patient['nom']) ?> <?= htmlspecialchars($patient['prenom']) ?></button>

    <!-- Prescription -->
    <button onclick="window.location.href='prescription.php?id_patient=<?php echo $patient['id_patient']; ?>'">Prescription</button>
    
    <!-- Suivi -->
    <button onclick="window.location.href='suivi.php?id_patient=<?php echo $patient['id_patient']; ?>'">Suivi</button>
        
    <!-- Documents -->
    <button onclick="goToDocuments()">Documents</button>

    <!-- Antécédents -->
    <button onclick="goToAntécédents()">Antécédents</button>

    <!-- Laboratoire -->
    <button onclick="goToLaboratoire()">Laboratoire</button>

    <!-- Pop-up Patient -->
    <div id="patient-popup" style="display:none;">
        <div class="popup-overlay"></div>
        <div class="popup-container">
            <div class="popup-header">
                <h2>Profil</h2>
                <span class="close-popup-btn">&times;</span>
            </div>
            <div class="popup-content">
                <p>Prénom : <span id="prenom"></span></p>
                <p>Nom : <span id="nom"></span></p>
                <p>Sexe : <span id="sexe"></span></p>
                <p>ID User : <span id="id_patient"></span></p>
            </div>
        </div>
    </div>

</div>

<script src="../assets/script/patient.js"></script>