// Ouvre le popup pour afficher les informations d'un patient
function openPatientPopup(id_patient) {
    fetch(`../../backend/routes/patientRoutes.php?id_patient=${id_patient}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('prenom').innerText = data.prenom;
            document.getElementById('nom').innerText = data.nom;
            document.getElementById('id_patient').innerText = data.id_patient;
            document.getElementById('sexe').innerText = data.sexe;
        
            openPopup('patient-popup');
            document.getElementById('DPI').focus();
        })
}

// Redirige vers la page des prescriptions pour un patient spécifique
function redirectToDPI() {
    const idPatient = document.getElementById("id_patient").textContent;

    if (idPatient) {
        window.location.href = `prescription.php?id_patient=${idPatient.trim()}`;
    } else {
        alert("ID Patient introuvable !");
    }
}

// Variable pour déterminer le filtre par défaut (par nom)
let currentFilter = 'nom'; 

// Filtrer la liste des patients en fonction du champ de recherche et du filtre sélectionné
function filterPatients(filterType) {
    const input = document.getElementById('search-input');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('patient-list');
    const rows = table.getElementsByTagName('tr');

    // Mettre à jour le type de filtre en fonction de l'en-tête cliqué
    currentFilter = filterType; 

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');

        if (cells.length > 0) {
            let txtValue = '';

            // Déterminer quelle cellule utiliser pour le filtrage
            switch (currentFilter) {
                case 'enregistrement':
                    txtValue = cells[0].textContent || cells[0].innerText; // Colonne d'enregistrement
                    break;
                case 'nom':
                    txtValue = cells[1].textContent || cells[1].innerText; // Colonne du nom
                    break;
                case 'id':
                    txtValue = cells[2].textContent || cells[2].innerText; // Colonne ID Patient
                    break;
                case 'annee':
                    txtValue = cells[3].textContent || cells[3].innerText; // Colonne Année de Naissance
                    break;
                default:
                    break;
            }

            // Affiche ou cache la ligne en fonction du texte filtré
            rows[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
        }
    }
}

