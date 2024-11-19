import { updateCalendar } from './calendar-controls.js';
import { changeDay } from './global.js';

document.addEventListener('DOMContentLoaded', () => {
    // Le conteneur du calendrier
    const calendarTable = document.getElementById('calendar-body');

    // Les popup, à cacher ou à afficher
    const popup_create = document.getElementById('popup-create-meeting');
    const popup_show = document.getElementById('popup-show-meeting');
    const popup_edit = document.getElementById('popup-edit-meeting');

    // Les zones à cliquer pour cacher les popups
    const popup_create_overlay = document.getElementById('popup-create-overlay');
    const popup_show_overlay = document.getElementById('popup-show-overlay');
    const popup_edit_overlay = document.getElementById('popup-edit-overlay');

    // Les boutons de fermeture
    const close_create_btn = document.getElementById('close-popup-create-btn');
    const close_show_btn = document.getElementById('close-popup-show-btn');
    const close_edit_btn = document.getElementById('close-popup-edit-btn');


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
    
    // Écouter un clic sur l'overlay pour fermer la popup
    popup_create_overlay.addEventListener('click', () => {
        popup_create.style.display = 'none';  // Cacher la popup lorsque l'utilisateur clique en dehors
    });

    close_create_btn.addEventListener('click', () => {
        popup_create.style.display = 'none';  // Cacher la popup lorsque l'utilisateur clique en dehors
    });

    // Écouter un clic sur l'overlay pour fermer la popup
    popup_show_overlay.addEventListener('click', () => {
        popup_show.style.display = 'none';  // Cacher la popup lorsque l'utilisateur clique en dehors
    });

    close_show_btn.addEventListener('click', () => {
        popup_show.style.display = 'none';  // Cacher la popup lorsque l'utilisateur clique en dehors
    });

    popup_edit_overlay.addEventListener('click', () => {
        popup_edit.style.display = 'none';  // Cacher la popup lorsque l'utilisateur clique en dehors
    });

    close_edit_btn.addEventListener('click', () => {
        popup_edit.style.display = 'none';  // Cacher la popup lorsque l'utilisateur clique en dehors
    });
});


// La fonction pour créer une nouvelle réunion
function openNewMeetingPopup(date, hour) {
    console.log("Création");

    // Envoie les informations de date et heure nécessaires à la popup PHP
    fetch('../components/calendar/calendar-popup/create-meeting/create-meeting-content.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ date: date, hour: hour })  // Envoie la date et l'heure dans le corps de la requête
    })
    .then(response => response.text())
    .then(html => {
        console.log(html);
        document.getElementById('create-meeting-form').innerHTML = html;

        // Rendre la popup visible
        document.getElementById('popup-create-meeting').style.display = 'flex';
    })
    .catch(error => console.error('Erreur lors de l\'ouverture de la popup de création:', error));
}

// La fonction pour afficger une réunion déjà existante
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
        body: formData  // Utilisation de FormData ici
    })
    .then(response => response.text())  // Utiliser .text() pour voir la réponse brute
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
                return;  // Arrêter l'exécution si une erreur est renvoyée
            }

            // Une fois que vous avez les données du rendez-vous, envoyez-les à show-meeting-content.php
            fetch('../components/calendar/calendar-popup/show-meeting/show-meeting-content.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(rdvData)  // Envoi de toutes les données récupérées
            })
            .then(response => response.text())
            .then(data => {
                // Insérer le HTML retourné dans la popup
                document.getElementById('show-meeting-content').innerHTML = data;  
                document.getElementById('popup-show-meeting').style.display = 'flex';  // Afficher la popup
                
                // Assigner l'ID de la réunion à un attribut 'data' de la popup
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

