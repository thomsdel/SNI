<!-- header.php -->
<link rel="stylesheet" href="../assets/styles/header/header-styles.css">
<header>
    <div class="navbar">

        <!-- Navigation Buttons -->
        <button onclick="goToPreviousPage()">&#9664;&#9664;</button>
        <button onclick="goToNextPage()">&#9654;&#9654;</button>
            
        <!-- Refresh Button -->
        <button class="refresh-button" onclick="refreshPage()"><img src="../assets/images/refresh.png" alt="refresh"></button>
            
        <!-- Search Bar -->
        <div class="search-bar">
            <input type="search" id="barreDeRecherche" value="" oninput="RechercheOutil()">  
            <div id="motsTrouves" class="mots-trouves-dropdown"></div>
        </div>
            
        <!-- Calendar Button -->
        <button class="agenda-button" onclick="openCalendar()"><img src="../assets/images/agenda.png" alt="agenda"></button>
        
        <!-- Patient Button -->
        <button class="patient-button" onclick="openPatient()"><img src="../assets/images/patient.png" alt="patient"></button>

        <!-- Ouverture pop-up Utilisateur -->
        <button class="user-button" onclick="openUserPopup()">
            <img src="../assets/images/patient.png" alt="patient">
        </button>
        
        <!-- Pop-up Utilisateur -->
        <div id="user-popup" class="popup">
            <div class="popup-content">
                <span class="close" onclick="closeUserPopup()">&times;</span>
                <h2>Utilisateur</h2>
                <p>Prénom : <?= htmlspecialchars($_SESSION['prenom']) ?></p>
                <p>Nom : <?= htmlspecialchars($_SESSION['nom']) ?></p>
                <p>ID User : <?= htmlspecialchars($_SESSION['id_user']) ?></p>
            </div>
        </div>
    </div>
            
    <script src="../assets/scripts/header/scripts.js"></script>
</header>