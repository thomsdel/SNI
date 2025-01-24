// Pile pour gérer les pop-ups ouverts
document.addEventListener('DOMContentLoaded', function () {
    const popupStack = []; 


    // Fonction pour désactiver le scroll de la page
    function disableScroll() {
        document.body.style.overflow = 'hidden'; 
    }

    // Fonction pour réactiver le scroll de la page
    function enableScroll() {
        document.body.style.overflow = ''; 
    }


    // Fonction pour ouvrir un popup
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup && !popupStack.includes(popup)) {
            popupStack.push(popup); // Ajouter le popup à la pile
            popup.style.display = 'flex';

            // Désactiver le défilement si au moins un popup est ouvert
            disableScroll();
        }
    }

    // Fonction pour fermer le dernier popup ouvert
    function closePopup() {
        if (popupStack.length > 0) {
            const lastPopup = popupStack.pop(); // Retirer le dernier popup
            lastPopup.style.display = 'none';
            // Réactiver le défilement si tous les popups sont fermés
            if (popupStack.length === 0) {
                enableScroll();
            }
        }
    }

    // Gérer le clic sur un élément avec la classe "popup-overlay"
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('popup-overlay') ) {
            closePopup(); 
        }
    });

    // Gérer le clic sur un bouton avec la classe "close-popup-btn"
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('close-popup-btn')) {
            closePopup();
        }
    });

    // Gérer l'appui sur la touche "Échap"
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closePopup(); 
        }
    });

    // Ajouter à `window` pour un usage dans d'autres scripts
    window.openPopup = openPopup; 
    window.closePopup = closePopup; 

});
