// Fonction pour rediriger vers la page "Liste des patients"
function goToListePatient() {
    window.location.href = "liste_patient.php";
}

// Fonction pour rediriger vers la page "Consultation"
function goToConsultation() {
    window.location.href = "consultation.php";
}

// Fonction pour rediriger vers la page "Saisie fiche admin"
function goToSaisie() {
    window.location.href = "saisie_fiche_admin.php";
}

// Détecter la page actuelle
const currentPage = window.location.pathname.split('/').pop(); // Exemple : "consultation.php"

// Ajouter la classe "active" au bouton correspondant
document.querySelectorAll('.onglet button').forEach(button => {
    if (button.getAttribute('data-page') === currentPage) {
        button.classList.add('active');
    }
});
