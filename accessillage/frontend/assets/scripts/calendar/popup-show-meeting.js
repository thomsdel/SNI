document.addEventListener('DOMContentLoaded', () => {
    const popupContainer = document.getElementById('meetingPopup');
    
    if (popupContainer) {
        popupContainer.addEventListener('click', (event) => {
            if (event.target.id === 'closePopupBtn') {
                console.log("Fermer");
                closePopup();
            }
            
            // Vérifier si le bouton de suppression a été cliqué
            if (event.target.id === 'deleteMeetingBtn') {
                const meetingId = popupContainer.dataset.meetingId; // Récupérer l'ID de la réunion
                console.log('Id :');
                console.log(meetingId);
                
                if (meetingId) {
                    console.log("Delete");
                    
                    deleteMeeting(meetingId); // Passer l'ID à la fonction de suppression
                }
            }

            if (event.target.id === 'editMeetingBtn') {
                const meetingId = popupContainer.dataset.meetingId;
                editMeeting(meetingId);
            }
        });
    }
});

// Fonction pour supprimer la réunion
function deleteMeeting(meetingId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette réunion ?')) {
        fetch('../components/calendar/calendar-popup/delete-meeting.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_rdv: meetingId })  // Envoi de l'ID de la réunion à supprimer
        })
        .then(response => response.json())  
        .then(data => {
            if (data.status === 'success') {
                alert('Réunion supprimée avec succès');
                closePopup();  // Fermer la popup
                location.reload();  // Recharger la page pour voir les changements
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la suppression de la réunion.');
        });
    }
}




    // Fonction pour fermer la popup
    function closePopup() {
        document.getElementById('meetingPopup').style.display = 'none'; // Masquer la popup
    }


// Fonction pour ouvrir la popup d'édition de réunion
// Fonction pour ouvrir la popup d'édition de réunion
function editMeeting(meetingId) {
    console.log("Modification de la réunion:", meetingId);
    
    fetch('../components/calendar/calendar-popup/edit-meeting.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id_rdv: meetingId })  // Envoi de l'ID de la réunion pour obtenir les détails
    })
    .then(response => response.json())  // On attend une réponse JSON
    .then(data => {
        // Vérifier que les données sont valides
        if (data.status === 'success') {
            const meeting = data.meeting;  // Supposons que la réponse contienne l'objet 'meeting'
            const doctors = data.doctors;  // Liste des docteurs
            const patients = data.patients;  // Liste des patients

            // Générer le formulaire avec les informations de la réunion
            const formHtml = `
                <form id="editMeetingForm">
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" value="${meeting.titre_rdv}" required>

                    <label for="sector">Secteur :</label>
                    <input type="text" id="sector" name="sector" value="${meeting.secteur}" required>

                    <label for="startDate">Date de début :</label>
                    <input type="datetime-local" id="startDate" name="startDate" value="${meeting.date_debut}" required>

                    <label for="duration">Durée :</label>
                    <input type="text" id="duration" name="duration" value="${meeting.duree}" required>

                    <label for="remarks">Remarques :</label>
                    <textarea id="remarks" name="remarks">${meeting.remarques}</textarea>

                    <label for="doctor">Docteur :</label>
                    <select id="doctor" name="doctor" required>
                        ${doctors.map(doctor => 
                            `<option value="${doctor.id_doc}" ${doctor.id_doc == meeting.id_doc ? 'selected' : ''}>${doctor.full_name}</option>`
                        ).join('')}
                    </select>

                    <label for="patient">Patient :</label>
                    <select id="patient" name="patient" required>
                        ${patients.map(patient => 
                            `<option value="${patient.id_patient}" ${patient.id_patient == meeting.id_patient ? 'selected' : ''}>${patient.full_name}</option>`
                        ).join('')}
                    </select>

                    <button type="submit">Mettre à jour</button>
                </form>
            `;

            // Insérer le formulaire dans la popup
            document.getElementById('meetingPopupContent').innerHTML = formHtml;
            document.getElementById('meetingPopup').style.display = 'block';  // Afficher la popup
            document.getElementById('meetingPopup').dataset.meetingId = meetingId;  // Ajouter l'ID de la réunion

            // Ajouter l'événement pour la soumission du formulaire
            document.getElementById('editMeetingForm').addEventListener('submit', function(event) {
                event.preventDefault();  // Empêcher la soumission par défaut du formulaire
                
                // Récupérer les nouvelles données du formulaire
                const updatedMeeting = {
                    id_rdv: meetingId,
                    title: document.getElementById('title').value,
                    sector: document.getElementById('sector').value,
                    startDate: document.getElementById('startDate').value,
                    duration: document.getElementById('duration').value,
                    remarks: document.getElementById('remarks').value,
                    doctor: document.getElementById('doctor').value,
                    patient: document.getElementById('patient').value
                };

                // Envoyer les nouvelles données au backend
                updateMeeting(updatedMeeting);
            });
        } else {
            alert('Erreur lors du chargement des détails de la réunion.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la récupération des détails de la réunion.');
    });
}


// Fonction pour mettre à jour la réunion
function updateMeeting(updatedMeeting) {
    fetch('../components/calendar/calendar-popup/update-meeting.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(updatedMeeting)  // Envoi des données de la réunion à mettre à jour
    })
    .then(response => response.json())  
    .then(data => {
        if (data.status === 'success') {
            alert('Réunion mise à jour avec succès');
            closePopup();  // Fermer la popup
            location.reload();  // Recharger la page pour voir les changements
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la mise à jour de la réunion.');
    });
}

