import { updateCalendar } from './calendar-controls.js';

// Attendre que le DOM soit complètement chargé avant de lier l'événement
document.addEventListener('DOMContentLoaded', function() {
    // Vérifier que le formulaire existe bien
    const form = document.getElementById('create-meeting-form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Empêcher la soumission classique du formulaire

            const formData = new FormData(form); // Utiliser l'objet 'form' ici
            const data = {
                titre: formData.get('titre_rdv'),
                secteur: formData.get('secteur_rdv'),
                id_patient: formData.get('patient'),
                id_doc: formData.get('medecin'),
                date_debut: formData.get('date_debut_rdv'),
                duree: formData.get('duree_rdv'),
                remarques: formData.get('remarques_rdv')
            };

            // Envoyer les données à PHP via Fetch API
            fetch('../components/calendar/calendar-popup/create-meeting.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'success') {
                    // alert('Réunion créée avec succès');
                    updateCalendar();
                    // Optionnel: Fermer la popup ou vider le formulaire
                    document.getElementById('create-meeting-form').reset();
                    // Ou cacher la popup
                    document.getElementById('popup-create-meeting-container').style.display = 'none';
                } else {
                    alert('Erreur: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });
    } else {
        console.error('Formulaire non trouvé.');
    }
});
