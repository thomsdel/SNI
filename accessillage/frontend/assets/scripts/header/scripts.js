function goToPreviousPage() {
    // Ajoutez ici la logique pour aller à la page précédente
    window.history.back();
}

function goToNextPage() {
    // Ajoutez ici la logique pour aller à la page suivante
    window.history.forward();
}

function refreshPage() {
    // Logique pour rafraîchir la page
    window.location.reload();
}

function openCalendar() {
    window.location.href = "calendar.php";
}

function openPatient() {
    window.location.href = "liste_patient.php";
}

function openUserPopup() {
    document.getElementById('user-popup').style.display = 'block';
}

function closeUserPopup() {
    document.getElementById('user-popup').style.display = 'none';
}

// Ferme le pop-up si l'utilisateur clique en dehors de la boîte de contenu
window.onclick = function(event) {
    const popup = document.getElementById('user-popup');
    if (event.target === popup) {
        popup.style.display = 'none';
    }
}

function openDeconnexion() {
    window.location.href = "navbar/se_deconnecter.php";
}

function goToLoginPage() {
    window.location.href = "../login.php"; 
}

function RechercheOutil() {
    const searchText = document.getElementById("barreDeRecherche").value.toLowerCase();
    const allElements = document.querySelectorAll("*");
    const motsTrouvesDropdown = document.getElementById("motsTrouves");
    const motsTrouves = new Set();

    allElements.forEach(element => {
        if (element.children.length === 0 && element.textContent.trim() !== "") {
            const elementText = element.textContent.trim().toLowerCase();
            const words = elementText.split(/[\s']+/);

            if (searchText !== "" && words.some(word => word.startsWith(searchText) && word !== "de" && word !== "d'")) {
                element.classList.add("highlight");
                motsTrouves.add(element.textContent.trim());
            } else {
                element.classList.remove("highlight");
            }
        }
    });

    updateDropdown(motsTrouves, motsTrouvesDropdown);
}