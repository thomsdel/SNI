import { resetCurrentDate, changeMonth, getCurrentDate, toggleViewMode, changeDate, getViewMode } from './global.js';

// Fonction pour mettre à jour l'affichage du calendrier
export function updateCalendar() {
    const monthDisplay = document.getElementById('currentMonth');
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
    const monthSelectorPopup = document.getElementById('monthSelector-popup');
    const currentMonthSpan = document.getElementById('currentMonth');
    const prevMonthButton = document.getElementById('prevMonthButton');
    const nextMonthButton = document.getElementById('nextMonthButton');
    const confirmDateButton = document.getElementById('confirmDate');
    const monthSelect = document.getElementById('monthSelect');
    const yearSelect = document.getElementById('yearSelect');
    const todayButton = document.getElementById('todayButton');
    const viewModeButton = document.getElementById('viewModeButton');
    const prevDateButton = document.getElementById('prevDateButton'); // Bouton pour reculer d'un jour/7 jours
    const nextDateButton = document.getElementById('nextDateButton'); // Bouton pour avancer d'un jour/7 jours

    prevDateButton.addEventListener('click', () => {
        if (getViewMode() === "Jour") {
            changeDate(-1); // Appelle la fonction pour reculer d'un jour
        }
        else {
            changeDate(-7); // Appelle la fonction pour reculer de 7 jours
        }
        updateCalendar();
    })

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
        monthSelectorPopup.style.display = 'block';
    });

    // Masque la popup en cliquant ailleurs
    document.addEventListener('click', (event) => {
        if (!monthSelectorPopup.contains(event.target) && event.target !== currentMonthSpan) {
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

    confirmDateButton.addEventListener('click', () => {
        const month = monthSelect.value; // Récupère le mois sélectionné
        const year = yearSelect.value; // Récupère l'année sélectionnée

        // Mise à jour manuelle de currentDate (peut nécessiter une fonction setter dans `global.js`)
        getCurrentDate().setMonth(month - 1); // Mois en 0-indexé
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
