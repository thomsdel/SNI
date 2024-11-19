// Script pour gérer les variables globales permettant de gérer le jour actuel et le mode de vue et leurs fonctions

export let currentDate = new Date(); // Variable initialisée à aujourd’hui
export let viewMode = "Semaine"; // Variable initialisée à "Semaine"

// Fonction pour remettre `currentDate` à aujourd'hui
export function resetCurrentDate() {
    currentDate = new Date(); // Réinitialise la date à aujourd'hui
}

// Fonction pour changer le mois (positive pour avancer, négative pour reculer)
export function changeMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
}

// Fonction pour changer le jour à "date" 
export function changeDay(date) {
    currentDate = new Date(date);
}

// Fonction pour changer le jour (positive pour avancer, négative pour reculer)
export function changeDate(direction) {
    currentDate.setDate(currentDate.getDate() + direction);
}

// Fonction pour obtenir la date actuelle 
export function getCurrentDate() {
    return currentDate;
}

// Fonction pour obtenir le mode de vue
export function getViewMode() {
    return viewMode;
}

// Fonction pour basculer le mode de vue de "jour" à "semaine"
export function toggleViewMode() {
    viewMode = viewMode === "Semaine" ? "Jour" : "Semaine";
}
