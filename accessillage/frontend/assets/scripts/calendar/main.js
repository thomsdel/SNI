// main.js

export let selectedDate = new Date(); // Déclaration à la racine

import { toggleViewMode, renderCalendar, viewMode } from './calendar-body.js';
import { } from './calendar-controls.js'; // Importation pour le monthSelector
import './popup-create-meeting.js'; // Assure-toi d'importer popup.js


document.addEventListener('DOMContentLoaded', () => {
    const calendar = document.getElementById('calendar');
    const todayButton = document.getElementById('todayButton');
    const viewModeButton = document.getElementById('viewModeButton');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const currentMonthSpan = document.getElementById('currentMonth'); // Référence à l'élément

    renderCalendar(calendar); // Afficher le calendrier initial
    updateMonthDisplay(); // Mettre à jour l'affichage du mois et de l'année

    // Fonction pour mettre à jour l'affichage du mois et de l'année
    function updateMonthDisplay() {
        const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        const month = selectedDate.getMonth();
        const year = selectedDate.getFullYear();
        currentMonthSpan.textContent = `${monthNames[month]} ${year}`; // Mettre à jour le texte du span
    }

    // Aujourd'hui
    todayButton.addEventListener('click', () => {
        selectedDate = new Date(); // Réinitialiser à la date actuelle
        renderCalendar(calendar); // Mettre à jour le calendrier
        updateMonthDisplay(); // Mettre à jour l'affichage du mois et de l'année
    });

    // Gestion des boutons "Précédent" et "Suivant"
    prevButton.addEventListener('click', () => {
        selectedDate.setDate(selectedDate.getDate() - (viewMode === 'week' ? 7 : 1));
        renderCalendar(calendar); // Mettre à jour le calendrier
        updateMonthDisplay(); // Mettre à jour l'affichage du mois et de l'année
    });

    nextButton.addEventListener('click', () => {
        selectedDate.setDate(selectedDate.getDate() + (viewMode === 'week' ? 7 : 1));
        renderCalendar(calendar); // Mettre à jour le calendrier
        updateMonthDisplay(); // Mettre à jour l'affichage du mois et de l'année
    });

    // Bouton Jour/Semaine
    viewModeButton.addEventListener('click', () => {
        toggleViewMode(calendar, viewModeButton);
    });
});
