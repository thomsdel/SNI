<div class="navbar">

    <!-- Boutons de navigation -->
    <button class="back-button" onclick="goToPreviousPage()"><img src="../assets/images/back.png" alt="retour"></button>
    <button class="next-button" onclick="goToNextPage()"><img src="../assets/images/next.png" alt="suivant"></button>
        
    <!-- Bouton de rafraîchissement -->
    <button class="refresh-button" onclick="refreshPage()"><img src="../assets/images/refresh.png" alt="refresh"></button>
        
    <!-- Barre de recherche principale -->
    <div class="search-bar">
        <input type="search" id="SearchInput" placeholder="Rechercher..." value="" oninput="searchText()">
    </div>
        
    <!-- Bouton du calendrier -->
    <button class="agenda-button" onclick="openCalendar()"><img src="../assets/images/agenda.png" alt="agenda"></button>
    
    <!-- Bouton patient -->
    <button class="patient-button" onclick="openPatient()"><img src="../assets/images/bed.png" alt="patient"></button>

    <!-- Ouverture pop-up utilisateur -->
    <button class="user-button" onclick="openUserPopup()">
        <img src="../assets/images/patient.png" alt="patient">
    </button>
    
    <!-- Pop-up utilisateur -->
    <div id="user-popup" style="display:none">
        <div class="popup-overlay"></div>
        <div class="popup-container">
            <div class="popup-header">
                <h2>Utilisateur</h2>
                <span class="close-popup-btn">&times;</span>
                <?php 
                if (isLoggedIn()) {
                    // Affichez les informations de l'utilisateur
                    $prenom = htmlspecialchars($_SESSION['prenom']);
                    $nom = htmlspecialchars($_SESSION['nom']);
                    $id_user = htmlspecialchars($_SESSION['id_user']);
                } else {
                    // Gérer le cas où les informations de l'utilisateur ne sont pas définies
                    $prenom = "Utilisateur";
                    $nom = "";
                    $id_user = "";
                }
                ?>
            </div>
            <div class="popup-content">
                <p>Prénom : <?= $prenom ?></p>
                <p>Nom : <?= $nom ?></p>
                <p>ID User : <?= $id_user ?></p>
            </div>
                <button class="reglages-button" onclick="openReglagesPopup()"><img src="../assets/images/reglages.png" alt="reglages"></button>
                <button class="deconnexion-button" onclick="openDeconnexion()"><img src="../assets/images/deconnexion.png" alt="deconnexion" id="deconnexion"></button>
        </div>
    </div>

    <!-- Pop-up réglages -->
    <div id="reglages-popup" style="display:none">
    <div class="popup-overlay" id="reglages-overlay"></div>
        <div class="popup-container">
            <div class="popup-header">
                <h2>Réglages</h2>
                <span class="close-popup-btn">&times;</span>
            </div>
            <form class="popup-content">

                <fieldset>
                    <legend>Thème et personnalisation de l'interface :</legend>
                    
                    <!-- Groupe 1 : Mode Sombre, Taille Police, Thème Couleur -->
                    <div class="groupe1">
                    <label for="font-size-select">Taille de Police :</label>
                        <select id="font-size-select">
                            <option value="normal">Normal</option>
                            <option value="large">Grand</option>
                            <option value="very-large">Très Grand</option>
                        </select>

                        <!-- Sélection du thème -->
                        <label for="theme-select">Thème :</label>
                        <select id="theme-select">
                            <option value="white">Thème Blanc (Classique)</option>
                            <option value="dark">Thème Sombre</option>
                        </select>
                    </div>

                    <!-- Groupe 2 : Contraste Inversé et Police -->
                    <div class="groupe2">

                        <label for="font-family-select">Police :</label>
                        <select id="font-family-select">
                            <option value="default">Classique (Arial)</option>
                            <option value="opendyslexic">opendyslexic</option>
                            <option value="atkinson">Atkinson Hyperlegible</option>
                            <option value="luciole">Luciole</option>
                        </select>
                    </div>

                    <!-- Groupe 3 : Ajustement Espacement et Interligne -->
                    <div class="groupe3">
                    <label for="letter-spacing-select">Ajustement Espacement :</label>
                        <select id="letter-spacing-select">
                            <option value="normal" selected>Normal</option>
                            <option value="wide">Large</option>
                        </select>

                        <label for="line-spacing-select">Ajustement Interligne :</label>
                        <select id="line-spacing-select">
                            <option value="narrow">Étroit</option>
                            <option value="normal" selected>Normal</option>
                            <option value="wide">Large</option>
                        </select>
                    </div>
                </fieldset>

                <!-- Bouton Appliquer -->
                <button type="button" onclick="applySettings()">Appliquer</button>
            </form>
        </div>
    </div>

</div>
<script type="module" src='../assets/script/popup.js'></script>
<script src="../assets/script/navbar.js"></script>
