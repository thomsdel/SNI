// global.js
export let currentDate = new Date(); // Variable globale initialisée à aujourd’hui
export let viewMode = "Semaine"; // Variable globale initialisée à "Semaine"

// Fonction pour remettre `currentDate` à aujourd'hui
export function resetCurrentDate() {
    currentDate = new Date(); // Réinitialise la date à aujourd'hui
}

// Fonction pour changer le mois (positive pour avancer, négative pour reculer)
export function changeMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
}

export function changeDay(date) {
    currentDate = new Date(date);
}

// Fonction pour changer le jour (positive pour avancer, négative pour reculer)
export function changeDate(direction) {
    currentDate.setDate(currentDate.getDate() + direction);
}

// Fonction pour obtenir la date actuelle (si besoin)
export function getCurrentDate() {
    return currentDate;
}

export function getViewMode() {
    return viewMode;
}

// Fonction pour basculer le mode de vue
export function toggleViewMode() {
    viewMode = viewMode === "Semaine" ? "Jour" : "Semaine";
}
