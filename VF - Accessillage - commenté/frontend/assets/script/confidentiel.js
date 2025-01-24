// Récupération du bouton pour changer de mode et des éléments confidentiels
const boutonMode = document.getElementById('Changement_mode');
const elementsConfidentiels = document.querySelectorAll('.confidentiel');

// Ajout d'un événement sur le bouton pour activer/désactiver le mode d'accessibilité
boutonMode.addEventListener('click', function () {
    document.body.classList.toggle('mode_accessibilite');

    // Si le mode est activé, changement du texte du bouton et modification des attributs des éléments confidentiels
    if (document.body.classList.contains('mode_accessibilite')) {
        boutonMode.textContent = "Désactiver le mode d'accessibilité";
        elementsConfidentiels.forEach(function (element) {
            // Masque les éléments confidentiels avec 'aria-hidden' et 'aria-label'
            element.setAttribute('aria-hidden', 'true');
            element.setAttribute('aria-label', 'Donnée confidentielle');
        });
    } else {
        // Si le mode est désactivé, réinitialisation des attributs des éléments confidentiels
        boutonMode.textContent = "Activer le mode d'accessibilité";
        elementsConfidentiels.forEach(function (element) {
            element.removeAttribute('aria-hidden');
            element.removeAttribute('aria-label');
        });
    }
});

// Ajout d'événements pour gérer la mise à jour des attributs lorsque l'élément confidentiel reçoit le focus ou est survolé
elementsConfidentiels.forEach(function (element) {
    element.addEventListener('focus', function () {
        if (document.body.classList.contains('mode_accessibilite')) {
            // Lors du focus, on masque l'élément confidentiel si le mode est activé
            element.setAttribute('aria-hidden', 'true');
            element.setAttribute('aria-label', 'Donnée confidentielle');
        }
    });

    element.addEventListener('mouseover', function () {
        if (document.body.classList.contains('mode_accessibilite')) {
            // Lors du survol, on masque l'élément confidentiel si le mode est activé
            element.setAttribute('aria-hidden', 'true');
            element.setAttribute('aria-label', 'Donnée confidentielle');
        }
    });
});

