import { updateCalendar } from './calendar-controls.js';

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('create-meeting-form');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche la soumission classique du formulaire

            const formData = new FormData(form); // Prépare les données du formulaire
            formData.append('action', 'add'); // Ajoute l'action à envoyer en POST
            // Pour afficher les champs et leurs valeurs
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }            
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
                console.log("Réponse du serveur :", responseText); // Affiche la réponse dans la console

                // Rafraîchit le calendrier et ferme la popup si le rendez-vous est ajouté avec succès
                updateCalendar();
                form.reset();
                document.getElementById('popup-create-meeting').style.display = 'none';
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
