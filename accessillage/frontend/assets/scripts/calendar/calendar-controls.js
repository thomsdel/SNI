import { resetCurrentDate, changeMonth, getCurrentDate, toggleViewMode, changeDate, getViewMode } from './global.js';

// Fonction pour mettre à jour l'affichage du calendrier
export function updateCalendar() {
    const monthDisplay = document.getElementById('current-month');
    const date = getCurrentDate();
    monthDisplay.innerText = capitalizeFirstLetter(date.toLocaleString('default', { month: 'long', year: 'numeric' }));
    console.log(date);

    // Envoi de la date à PHP via POST pour récupérer les nouvelles données du calendrier
    fetch('../components/calendar/calendar-body.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ currentDate: date })
    })
    .then(response => response.text())
    .then(data => {
        // Ici on met à jour uniquement le corps du calendrier, pas tout le conteneur
        document.getElementById('calendar-body').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

// Fonction pour mettre la première lettre en majuscule
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

document.addEventListener('DOMContentLoaded', () => {
    const monthSelectorPopup = document.getElementById('month-selector-popup-container'); // La popup pour changer de mois 
    const currentMonthSpan = document.getElementById('current-month'); // Bouton pour ouvrir la popup de chois de mois
    const prevMonthButton = document.getElementById('prev-month-button'); // Bouton pour passer au moins précédent
    const nextMonthButton = document.getElementById('next-month-button'); // Bouton pour passer au mois suivant
    const confirmDateButton = document.getElementById('confirm-date'); // Bouton pour confirmer la date dans la popup
    const monthSelect = document.getElementById('month-select'); // Le sélecteur de mois dans la popup
    const yearSelect = document.getElementById('year-select'); // Le sélecteur d'année dans la popup 
    const todayButton = document.getElementById('today-button'); // Bouton pour revenir à aujourd'hui
    const viewModeButton = document.getElementById('view-mode-button'); // Bouton pour changer de mode de vue
    const prevDateButton = document.getElementById('prev-date-button'); // Bouton pour reculer d'un jour/7 jours
    const nextDateButton = document.getElementById('next-date-button'); // Bouton pour avancer d'un jour/7 jours

    // On recule dans les jours
    prevDateButton.addEventListener('click', () => {
        if (getViewMode() === "Jour") {
            changeDate(-1); // Appelle la fonction pour reculer d'un jour
        }
        else {
            changeDate(-7); // Appelle la fonction pour reculer de 7 jours
        }
        updateCalendar();
    })

    // On avance dans les jours
    nextDateButton.addEventListener('click', () => {
        if (getViewMode() === "Jour") {
            changeDate(1); // Appelle la fonction pour avancer d'un jour
        }
        else {
            changeDate(7); // Appelle la fonction pour avancer de 7 jours
        }
        updateCalendar();
    })

    // Affiche la popup de sélection de mois
    currentMonthSpan.addEventListener('click', () => {
        monthSelect.value = getCurrentDate().getMonth() + 1; // +1 car getMonth() retourne un index 0-11
        yearSelect.value = getCurrentDate().getFullYear(); // Définit l'année actuelle
        monthSelectorPopup.style.display = 'flex';
    });

    // Fonction pour détecter le clic à l'extérieur de la popup
    monthSelectorPopup.addEventListener('click', (event) => {   
        // Si le clic est en dehors de la popup, on masque la popup
        if (event.target === monthSelectorPopup) {
            monthSelectorPopup.style.display = 'none';
        }
    });

    // Navigation entre mois
    prevMonthButton.addEventListener('click', () => {
        changeMonth(-1); // Appelle la fonction pour reculer d’un mois
        updateCalendar();
    });

    nextMonthButton.addEventListener('click', () => {
        changeMonth(1); // Appelle la fonction pour avancer d’un mois
        updateCalendar();
    });

    // En confirmant dans la popup
    confirmDateButton.addEventListener('click', () => {
        const month = monthSelect.value; // Récupère le mois sélectionné
        const year = yearSelect.value; // Récupère l'année sélectionnée

        // Mise à jour manuelle de currentDate
        getCurrentDate().setMonth(month - 1); // Mois en 0-indexé (d'où le -1)
        getCurrentDate().setFullYear(year); // Met à jour l'année

        monthSelectorPopup.style.display = 'none'; // Ferme le popup après confirmation
        updateCalendar(); // Met à jour l'affichage du calendrier
    });

    todayButton.addEventListener('click', () => {
        resetCurrentDate(); // Réinitialise la date à aujourd'hui
        updateCalendar();
    });

    viewModeButton.addEventListener('click', () => {
        toggleViewMode(); // Bascule entre "Semaine" et "Jour"
        viewModeButton.innerText = viewModeButton.innerText === "Semaine" ? "Jour" : "Semaine";
        updateCalendar(); // Met à jour l'affichage du calendrier
    });

    updateCalendar(); // Appelle la fonction au démarrage
});
