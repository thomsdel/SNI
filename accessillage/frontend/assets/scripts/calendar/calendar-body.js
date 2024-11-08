import { updateCalendar } from './calendar-controls.js';
import { changeDay } from './global.js';

document.addEventListener('DOMContentLoaded', () => {
    // Sélectionner le conteneur du calendrier
    const calendarTable = document.getElementById('calendar-body');

    // Utiliser la délégation d'événements pour détecter les clics sur les jours du calendrier et les réunions
    calendarTable.addEventListener('click', (event) => {
        // Vérifier si un jour du calendrier a été cliqué
        const day = event.target.closest('.day-line');
        if (day) {
            // Récupérer la date de chaque case grâce à l'attribut "data-date"
            const selectedDate = day.getAttribute('data-date');

            // Appeler changeDate avec la date sélectionnée
            changeDay(selectedDate);

            // Mettre à jour l'affichage du calendrier
            updateCalendar();
            return; // On sort pour éviter d'exécuter d'autres actions
        }

        // Vérifier si une cellule du calendrier a été cliquée
        const cell = event.target.closest('.calendar-cell');
        if (cell) {
            // Vérifier s'il y a une réunion dans la cellule
            const meeting = cell.querySelector('.meeting');
            if (meeting) {
                // Récupérer l'ID de la réunion
                const meetingId = meeting.getAttribute('data-meeting-id');
                // Ouvrir le popup pour afficher/modifier la réunion
                openMeetingPopup(meetingId);
            } else {
                // Si la cellule est vide, ouvrir le popup pour créer une réunion
                const cellDate = cell.getAttribute('data-date');
                const cellHour = cell.getAttribute('data-hour');
                openNewMeetingPopup(cellDate, cellHour);
            }
        }

    });
});

function openNewMeetingPopup(date, hour) {
    console.log("Modification");

    fetch('../components/calendar/calendar-popup/popup-create-meeting.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ date: date, hour: hour })  // Envoie la date et l'heure dans le corps de la requête
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('create-meeting-form').innerHTML = html;
        document.getElementById('create-meeting-form-container').style.display = 'block'; // Afficher la popup
    })
    .catch(error => console.error('Erreur lors de l\'ouverture de la popup de création:', error));
}

function openMeetingPopup(meetingId) {
    console.log(meetingId);
    
    fetch('../components/calendar/calendar-popup/popup-show-meeting.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id_rdv: meetingId })  // Envoi de l'ID de la réunion dans le corps de la requête
    })
    .then(response => response.text())  // Utiliser response.text() car on attend du HTML
    .then(data => {
        // Insérer le HTML retourné dans la popup
        document.getElementById('meetingPopupContent').innerHTML = data;  // Injecter le contenu dans la div 'meetingPopupContent'
        document.getElementById('meetingPopup').style.display = 'flex';  // Afficher la popup
                
        // Assigner l'ID de la réunion à un attribut 'data' de la popup
        document.getElementById('meetingPopup').dataset.meetingId = meetingId;
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la récupération des détails de la réunion.');
    });
}

function closePopup() {
    document.getElementById('meetingPopup').style.display = 'none';  // Cacher la popup
}




