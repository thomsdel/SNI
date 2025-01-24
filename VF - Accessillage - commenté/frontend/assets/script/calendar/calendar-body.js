import { updateCalendar } from './calendar-controls.js';
import { changeDay } from './global.js';

document.addEventListener('DOMContentLoaded', () => {
    // Le conteneur du calendrier
    const calendarTable = document.getElementById('calendar-body');

    // On récupère le potentiel ID du patient
    const id_patient = getPatientId(); 

    // Gérer les clics ou appuis sur Entrée/Espace pour les éléments du calendrier
    calendarTable.addEventListener('click', handleCalendarInteraction);
    calendarTable.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') { // Espace ou Entrée
            event.preventDefault(); // Empêche le comportement par défaut (ex : scroll pour Espace)
            handleCalendarInteraction(event);
        }
    });

        
    // Vérifie si un jour du calendrier a été cliqué ou sélectionné
    function handleCalendarInteraction(event) {
        const day = event.target.closest('.day-line');
        if (day) {
            const selectedDate = day.getAttribute('data-date');
            changeDay(selectedDate); 
            updateCalendar(); 
            return; 
        }

        // Vérifie si une cellule du calendrier a été cliquée ou sélectionnée
        const cell = event.target.closest('.calendar-cell');
        if (cell) {
            const meeting = cell.querySelector('.meeting');
            if (meeting) {
                const meetingId = meeting.getAttribute('data-meeting-id');
                openMeetingPopup(meetingId, id_patient); // Afficher/modifier une réunion
            } else {
                const cellDate = cell.getAttribute('data-date');
                const cellHour = cell.getAttribute('data-hour');
                openNewMeetingPopup(cellDate, cellHour, id_patient); // Créer une nouvelle réunion
            }
        }
    }
});


// Vérifie si un paramètre id_patient existe dans l'URL
function getPatientId() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.has('id_patient') ? urlParams.get('id_patient') : null;
}

// Créer une nouvelle réunion
export function openNewMeetingPopup(date_rdv, hour, id_patient) {
    console.log(date_rdv);
    console.log(hour);

    // Envoie les informations de date et heure nécessaires au popup PHP
    fetch('../components/calendar/calendar-popup/create-meeting/create-meeting-content.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            date_rdv: date_rdv, 
            hour: hour,
            id_patient: id_patient || null // Si pas d'ID, envoyer null

        })  // Envoie la date et l'heure dans le corps de la requête
    })
    .then(response => response.text())
    .then(html => {
        console.log(html);
        document.getElementById('create-meeting-form').innerHTML = html;

        // Rendre le popup visible
        openPopup('popup-create-meeting');
        document.getElementById('titre_rdv_create').focus();
    })
    .catch(error => console.error('Erreur lors de l\'ouverture de la popup de création:', error));
}

// Affiche une réunion déjà existante
function openMeetingPopup(meetingId) {
    console.log("Affichage/Modification");
    console.log(meetingId);

    // Créer un formulaire FormData
    const formData = new FormData();
    formData.append("id_rdv", meetingId);  // Ajouter l'ID du rendez-vous au formData
    formData.append("action", 'get');

    // Envoi de la requête avec FormData
    fetch('../../backend/routes/rdvRoutes.php', {
        method: 'POST',
        body: formData  
    })
    .then(response => response.text()) 
    .then(responseText => {
        console.log("Réponse brute du serveur:", responseText);  // Affiche la réponse brute du serveur

        // Tenter de parser la réponse en JSON
        try {
            const rdvData = JSON.parse(responseText);
            console.log(rdvData);

            // Vérifier si la réponse contient une erreur
            if (rdvData.error) {
                console.error("Erreur du serveur:", rdvData.error);
                alert('Erreur lors de la récupération des données du rendez-vous : ' + rdvData.error);
                return; 
            }

            // Une fois que vous avez les données du rendez-vous, envoyez-les à show-meeting-content.php
            fetch('../components/calendar/calendar-popup/show-meeting/show-meeting-content.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(rdvData) 
            })
            .then(response => response.text())
            .then(data => {
                // Insérer le HTML retourné dans le popup
                document.getElementById('show-meeting-content').innerHTML = data;  
                openPopup('popup-show-meeting');
                document.getElementById('edit-meeting-btn').focus();

                // Assigner l'ID de la réunion à un attribut 'data' du popup
                document.getElementById('popup-show-meeting').dataset.meetingId = meetingId;
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des détails de la réunion:', error);
                alert('Erreur lors de la récupération des détails de la réunion.');
            });
        } catch (error) {
            console.error("Erreur de parsing JSON:", error);
            alert('La réponse du serveur n\'est pas au format attendu.');
        }
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des données du rendez-vous:', error);
        alert('Erreur lors de la récupération des données du rendez-vous.');
    });
}

