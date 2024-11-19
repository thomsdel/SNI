import { updateCalendar } from './calendar-controls.js';

document.addEventListener('DOMContentLoaded', () => {
    const popupContainer = document.getElementById('popup-show-meeting');
    
    if (popupContainer) {
        popupContainer.addEventListener('click', (event) => {          
            // Vérifier si le bouton de suppression a été cliqué
            if (event.target.id === 'delete-meeting-btn') {
                const meetingId = popupContainer.dataset.meetingId; // Récupérer l'ID de la réunion
                console.log('Id :');
                console.log(meetingId);
                
                if (meetingId) {
                    console.log("Delete");
                    
                    deleteMeeting(meetingId); // Passer l'ID à la fonction de suppression
                }
            }

            if (event.target.id === 'edit-meeting-btn') {
                const meetingId = popupContainer.dataset.meetingId;
                editMeeting(meetingId);
            }
        });
    }
});

// Fonction pour supprimer la réunion
function deleteMeeting(meetingId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette réunion ?')) {
        // Créer un formulaire FormData
        const formData = new FormData();
        formData.append("id_rdv", meetingId);  // Ajouter l'ID du rendez-vous au formData
        formData.append("action", 'delete');  // Ajouter l'ID du rendez-vous au formData

        // Envoi de la requête avec FormData
        fetch('../../backend/routes/rdvRoutes.php', {
            method: 'POST',
            body: formData  // Utilisation de FormData ici
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur du serveur");
            }
            return response.text(); // Lire la réponse en texte brut
        })
        .then(responseText => {
            // Rafraîchit le calendrier et ferme la popup si le rendez-vous est ajouté avec succès
            updateCalendar();
            document.getElementById('popup-show-meeting').style.display = 'none';
        })
        .catch(error => {
            console.error('Erreur lors de la création du rendez-vous:', error);
            alert('Erreur lors de la création du rendez-vous : ' + error.message);
        });
    }
}

// Fonction pour ouvrir la popup d'édition de réunion
function editMeeting(meetingId) {
    console.log("Modification de la réunion:", meetingId);

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
        const rdvData = JSON.parse(responseText);

        console.log("Envoyé :", rdvData);  // Affiche la réponse brute du serveur

        fetch('../components/calendar/calendar-popup/edit-meeting/edit-meeting-content.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(rdvData)  // Envoi de l'ID de la réunion pour obtenir les détails
        })
        .then(response => response.text())
        .then(html => {
            console.log(html);
            document.getElementById('edit-meeting-form').innerHTML = html;

            // Rendre la popup visible
            document.getElementById('popup-show-meeting').style.display = 'none';
            document.getElementById('popup-edit-meeting').style.display = 'flex';
        })
        .catch(error => console.error('Erreur lors de l\'ouverture de la popup de création:', error));
    })
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit-meeting-form');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche la soumission classique du formulaire

            const formData = new FormData(form); // Prépare les données du formulaire
            formData.append('action', 'edit'); // Ajoute l'action à envoyer en POST

            const id_rdv = document.getElementById('popup-show-meeting').dataset.meetingId;
            formData.append('id_rdv', id_rdv);
        
            // Envoi de la requête avec Fetch API
            fetch('../../backend/routes/rdvRoutes.php', {
                method: 'POST',
                body: formData // Envoie les données sous forme de formulaire
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erreur du serveur");
                }
                return response.text(); // Lire la réponse en texte brut
            })
            .then(responseText => {

                // Rafraîchit le calendrier et ferme la popup si le rendez-vous est ajouté avec succès
                updateCalendar();
                form.reset();
                document.getElementById('popup-edit-meeting').style.display = 'none';
            })
            .catch(error => {
                console.error('Erreur lors de la création du rendez-vous:', error);
                alert('Erreur lors de la création du rendez-vous : ' + error.message);
            });
        });
    } else {
        console.error('Formulaire non trouvé.');
    }
});
