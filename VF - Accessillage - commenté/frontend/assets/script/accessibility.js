// Sélectionner tous les éléments avec la classe 'confidentiel'
const elementsConfidentiels = document.querySelectorAll('.confidentiel');

// Fonction pour activer/désactiver le mode accessibilité
function toggleAccessibilityMode() {
    // Toggle the mode
    document.body.classList.toggle('mode_accessibilite');

    // Ajouter ou retirer les attributs d'accessibilité
    if (document.body.classList.contains('mode_accessibilite')) {
        elementsConfidentiels.forEach(element => {
            element.setAttribute('aria-hidden', 'true');
            element.setAttribute('aria-label', 'Donnée confidentielle');
        });

        // Sauvegarder l'état dans le localStorage
        localStorage.setItem('confidentialMode', 'activated');
    } else {
        elementsConfidentiels.forEach(element => {
            element.removeAttribute('aria-hidden');
            element.removeAttribute('aria-label');
        });

        // Sauvegarder l'état dans le localStorage
        localStorage.setItem('confidentialMode', 'deactivated');
    }

    // Message vocal ou texte pour informer de l'état
    const message = document.body.classList.contains('mode_accessibilite')
        ? "Mode accessibilité activé"
        : "Mode accessibilité désactivé";

    // Créer une région live pour le message
    const liveRegion = document.createElement('div');
    liveRegion.setAttribute('aria-live', 'assertive');
    liveRegion.style.position = 'absolute';
    liveRegion.style.left = '-9999px';
    liveRegion.textContent = message;
    document.body.appendChild(liveRegion);

    // Supprimer le message après 1 seconde
    setTimeout(() => {
        document.body.removeChild(liveRegion);
    }, 1000);

    // Retour vocal pour le mode confidentiel
    const confidentialMessage = document.body.classList.contains('mode_accessibilite')
        ? "Mode confidentiel activé"
        : "Mode confidentiel désactivé";

    const speech = new SpeechSynthesisUtterance(confidentialMessage);
    speech.lang = "fr-FR"; // Langue française
    speechSynthesis.speak(speech);
}

// Vérifier si le mode confidentiel est activé au chargement de la page
window.addEventListener('load', function() {
    const confidentialModeState = localStorage.getItem('confidentialMode');
    
    if (confidentialModeState === 'activated') {
        // Si le mode confidentiel est activé, l'activer au chargement
        document.body.classList.add('mode_accessibilite');
        elementsConfidentiels.forEach(element => {
            element.setAttribute('aria-hidden', 'true');
            element.setAttribute('aria-label', 'Donnée confidentielle');
        });
    }
});

// Raccourci clavier pour activer/désactiver le mode accessibilité
document.addEventListener('keydown', function (event) {
    const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;

    if (
        (isMac && event.metaKey && event.shiftKey && event.key === 'M') ||
        (!isMac && event.ctrlKey && event.shiftKey && event.key === 'M')
    ) {
        toggleAccessibilityMode();
        event.preventDefault();
    }
});
