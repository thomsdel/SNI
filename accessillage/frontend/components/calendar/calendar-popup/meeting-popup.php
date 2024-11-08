<!-- Structure de la popup pour afficher les détails d'une réunion -->
<div id="meetingPopup" style="display:none;">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Details de la Réunion</h2>
            <button id="closePopupBtn">X</button>
        </div>
        <div id="meetingPopupContent">
            <!-- Le contenu des détails de la réunion sera injecté ici par le JavaScript -->
        </div>
        <div class="popup-footer">
            <button id="editMeetingBtn">Modifier</button>
            <button id="deleteMeetingBtn">Supprimer</button>
        </div>
    </div>
</div>

<style>
    #meetingPopup {
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
    #meetingPopupContent {
        margin-top: 20px;
    }
</style>
