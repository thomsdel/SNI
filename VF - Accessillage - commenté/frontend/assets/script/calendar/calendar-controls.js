import { resetCurrentDate, changeMonth, getCurrentDate, toggleViewMode, changeDate, getViewMode, formatDate, formatHour } from './global.js';
import { openNewMeetingPopup} from './calendar-body.js';

// Fonction pour mettre à jour l'affichage du calendrier
export function updateCalendar() {
    const monthDisplay = document.getElementById('current-month');
    const date = getCurrentDate();
    monthDisplay.innerText = capitalizeFirstLetter(date.toLocaleString('default', { month: 'long', year: 'numeric' }));
    console.log(date);
    // On récupère le potentiel ID du patient
    const id_patient = getPatientId(); 
    
    // Envoi de la date à PHP via POST pour récupérer les nouvelles données du calendrier
    fetch('../components/calendar/calendar-body.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            currentDate: date,
            id_patient: id_patient || null // Si pas d'ID, envoyer null
        })
    })
    .then(response => response.text())
    .then(data => {
        // Ici on met à jour uniquement le corps du calendrier, pas tout le conteneur
        document.getElementById('calendar-body').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

// Vérifie si un paramètre id_patient existe dans l'URL
function getPatientId() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.has('id_patient') ? urlParams.get('id_patient') : null;
}


// Mettre la première lettre en majuscule
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

document.addEventListener('DOMContentLoaded', () => {
    const currentMonthSpan = document.getElementById('current-month'); // Bouton pour ouvrir le popup de chois de mois
    const prevMonthButton = document.getElementById('prev-month-button'); // Bouton pour passer au moins précédent
    const nextMonthButton = document.getElementById('next-month-button'); // Bouton pour passer au mois suivant
    const confirmDateButton = document.getElementById('confirm-date'); // Bouton pour confirmer la date dans le popup
    const monthSelect = document.getElementById('month-select'); // Le sélecteur de mois dans le popup
    const yearSelect = document.getElementById('year-select'); // Le sélecteur d'année dans le popup 
    const todayButton = document.getElementById('today-button'); // Bouton pour revenir à aujourd'hui
    const viewModeButton = document.getElementById('view-mode-button'); // Bouton pour changer de mode de vue
    const prevDateButton = document.getElementById('prev-date-button'); // Bouton pour reculer d'un jour/7 jours
    const nextDateButton = document.getElementById('next-date-button'); // Bouton pour avancer d'un jour/7 jours
    const newMeetingButton = document.getElementById('new-meeting-button'); // Bouton pour créer une réunion
    const month_select = document.getElementById('month-select');

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

    // Affiche le popup de sélection de mois
    currentMonthSpan.addEventListener('click', () => {
        monthSelect.value = getCurrentDate().getMonth() + 1; // +1 car getMonth() retourne un index 0-11
        yearSelect.value = getCurrentDate().getFullYear(); // Définit l'année actuelle
        // monthSelectorPopup.style.display = 'flex';
        openPopup('month-selector-popup-container');

        month_select.focus();
    });

    // Affiche le popup si on appuie sur "Entrée" lorsque l'élément a le focus
    currentMonthSpan.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') { // Vérifie si "Entrée" ou "Espace" est pressé
            event.preventDefault(); // Empêche le comportement par défaut (ex : défilement de la page)
            monthSelect.value = getCurrentDate().getMonth() + 1;
            yearSelect.value = getCurrentDate().getFullYear();
            // monthSelectorPopup.style.display = 'flex';
            openPopup('month-selector-popup-container');

            month_select.focus();
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

    // En confirmant dans le popup
    confirmDateButton.addEventListener('click', () => {
        const month = monthSelect.value; // Récupère le mois sélectionné
        const year = yearSelect.value; // Récupère l'année sélectionnée

        // Mise à jour manuelle de currentDate
        getCurrentDate().setMonth(month - 1); // Mois en 0-indexé (d'où le -1)
        getCurrentDate().setFullYear(year); // Met à jour l'année

        
        closePopup('month-selector-popup-container');
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

    newMeetingButton.addEventListener('click', () => {
        const currentDate = getCurrentDate();
        // Exemple d'utilisation
        let date_rdv = formatDate(currentDate); // "aaaa-mm-jj"
        let hour = formatHour(currentDate); // "hh"
        let id_patient = getPatientId();
        openNewMeetingPopup(date_rdv, hour, id_patient);
    });

    updateCalendar(); // Appelle la fonction au démarrage
});
