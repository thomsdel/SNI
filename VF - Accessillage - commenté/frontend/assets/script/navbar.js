// Retourne à la page précédente dans l'historique du navigateur
function goToPreviousPage() {
    window.history.back();
}

// Va à la page suivante dans l'historique du navigateur
function goToNextPage() {
    window.history.forward();
}

// Recharge la page actuelle
function refreshPage() {
    window.location.reload();
}

// Ouvre la page du calendrier
function openCalendar() {
    window.location.href = "calendrier.php";
}

// Ouvre la page de la liste des patients
function openPatient() {
    window.location.href = "liste_patient.php";
}

// Affiche le popup utilisateur
function openUserPopup() {
    openPopup('user-popup');
    document.getElementById('deconnexion').focus();
}

// Ferme le popup utilisateur
function closeUserPopup() {
    closePopup('user-popup');
}

// Affiche le popup réglages
function openReglagesPopup() {
    openPopup('reglages-popup');
    document.getElementById('langue').focus();
}

// Ferme le popup réglages
function closeReglagesPopup() {
    closePopup('reglages-popup');
}

// Ouvre la page de déconnexion (login)
function openDeconnexion() {
    window.location.href = "login.php";
}

// Ouvre la page de connexion
function goToLoginPage() {
    window.location.href = "../login.php";
}

// Fonction de recherche et surlignage via la barre de recherche
function searchText() {
    const searchTexts = document.getElementById("SearchInput").value.toLowerCase();
    clearHighlights(); // Enlever les anciens surlignages
    
    if (searchTexts === "") return; // Si la recherche est vide, on s'arrête ici

    // Cherche tous les éléments de texte dans le DOM
    const allElements = document.querySelectorAll("*");
    
    allElements.forEach(element => {
        // Ignorer les balises non textuelles et vides
        if (element.children.length === 0 && element.textContent.trim() !== "") {
            const mots = element.textContent.trim().split(/[\s']+/); // Séparer les mots
            
            // Vérifier chaque mot pour voir s'il commence par la recherche
            let matchFound = false;
            if (element.textContent.toLowerCase().replace(/\s+/g, ' ').includes(searchTexts.replace(/\s+/g, ' '))) {
                matchFound = true;
            }            
            mots.forEach(mot => {
                if (mot.toLowerCase().startsWith(searchTexts)) {
                    matchFound = true;
                }
            });

            // Si un match est trouvé, surligner l'élément
            if (matchFound) {
                element.classList.add("highlight");
            }
        }
    });
}

// Supprime les surlignages existants
function clearHighlights() {
    const highlightedElements = document.querySelectorAll(".highlight");
    highlightedElements.forEach(element => {
        element.classList.remove("highlight");
    });
}

// Applique les paramètres sauvegardés au chargement de la page
window.addEventListener('load', () => {
    // Thème
    pendingTheme = localStorage.getItem('selectedTheme') || 'white'; // Thème par défaut
    document.documentElement.classList.add(`theme-${pendingTheme}`);
    themeSelect.value = pendingTheme;

    // Taille de police
    pendingFontSize = localStorage.getItem('selectedFontSize') || 'normal'; // Taille par défaut
    document.documentElement.classList.add(`font-${pendingFontSize}`);
    fontSizeSelect.value = pendingFontSize;

    // Police de caractères
    pendingFontFamily = localStorage.getItem('selectedFontFamily') || 'default'; // Police par défaut
    document.documentElement.classList.add(`font-${pendingFontFamily}`);
    fontFamilySelect.value = pendingFontFamily;

    // Espacement
    pendingSpacing = localStorage.getItem('selectedSpacing') || 'normal'; // Espacement par défaut
    document.documentElement.classList.add(`spacing-${pendingSpacing}`);
    spacingSelect.value = pendingSpacing;

    // Interligne
    pendingLineSpacing = localStorage.getItem('selectedLineSpacing') || 'normal'; // Interligne par défaut
    document.documentElement.classList.add(`line-spacing-${pendingLineSpacing}`);
    lineSpacingSelect.value = pendingLineSpacing;
});

// Sélecteurs pour les paramètres
const themeSelect = document.getElementById('theme-select');
const fontSizeSelect = document.getElementById('font-size-select');
const fontFamilySelect = document.getElementById('font-family-select');
const spacingSelect = document.getElementById('letter-spacing-select');
const lineSpacingSelect = document.getElementById('line-spacing-select');

// Met à jour la variable temporaire pour chaque paramètre
themeSelect.addEventListener('change', () => {
    pendingTheme = themeSelect.value;
});

fontSizeSelect.addEventListener('change', () => {
    pendingFontSize = fontSizeSelect.value;
});

fontFamilySelect.addEventListener('change', () => {
    pendingFontFamily = fontFamilySelect.value;
});

spacingSelect.addEventListener('change', () => {
    pendingSpacing = spacingSelect.value;
});

lineSpacingSelect.addEventListener('change', () => {
    pendingLineSpacing = lineSpacingSelect.value;
});

// Fonction appelée au clic sur "Appliquer"
function applySettings() {
    // Supprime les anciennes classes pour éviter les conflits
    document.documentElement.classList.remove(
        'theme-white', 'theme-dark',
        'font-normal', 'font-large', 'font-very-large',
        'font-default',      'font-opendyslexic',      'font-atkinson',      'font-luciole',
        'font-default-bold', 'font-opendyslexic-bold', 'font-atkinson-bold', 'font-luciole-bold',
        'letter-spacing-normal', 'letter-spacing-wide',
        'line-spacing-narrow', 'line-spacing-normal', 'line-spacing-wide'
    );

    // Applique les nouvelles classes en fonction des sélections
    document.documentElement.classList.add(`theme-${pendingTheme}`);
    document.documentElement.classList.add(`font-${pendingFontSize}`);
    document.documentElement.classList.add(`font-${pendingFontFamily}`);
    document.documentElement.classList.add(`letter-spacing-${pendingSpacing}`);
    document.documentElement.classList.add(`line-spacing-${pendingLineSpacing}`);

    // Sauvegarde les paramètres dans le localStorage
    localStorage.setItem('selectedTheme', pendingTheme);
    localStorage.setItem('selectedFontSize', pendingFontSize);
    localStorage.setItem('selectedFontFamily', pendingFontFamily);
    localStorage.setItem('selectedSpacing', pendingSpacing);
    localStorage.setItem('selectedLineSpacing', pendingLineSpacing);

    closeReglagesPopup(); // Ferme le popup de réglages si applicable
}