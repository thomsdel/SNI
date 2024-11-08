<form id="editMeetingForm" style="display:none;">
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" value="Titre de la réunion" required>

    <label for="sector">Secteur :</label>
    <input type="text" id="sector" name="sector" value="Secteur de la réunion" required>

    <label for="startDate">Date de début :</label>
    <input type="datetime-local" id="startDate" name="startDate" value="2024-11-08T10:00" required>

    <label for="duration">Durée :</label>
    <input type="text" id="duration" name="duration" value="1 heure" required>

    <label for="remarks">Remarques :</label>
    <textarea id="remarks" name="remarks">Remarque initiale</textarea>

    <button type="submit">Mettre à jour</button>
</form>


<style>
    #editMeetingForm {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
    }
    .popup-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: 50%;
        max-width: 600px;
        margin: auto;
    }
    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .popup-footer {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    #editMeetingForm {
        margin-top: 20px;
    }
</style>
