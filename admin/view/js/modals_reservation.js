document.getElementById('openReservationModal').addEventListener('click', function () {
    document.getElementById('reservationModal').style.display = 'block';
});

document.getElementById('closeReservationModal').addEventListener('click', function () {
    document.getElementById('reservationModal').style.display = 'none';
});

document.getElementById('closeEditReservationModal').addEventListener('click', function () {
    document.getElementById('editReservationModal').style.display = 'none';
});

document.querySelectorAll('.edit-reservation-link').forEach(function (button) {
    button.addEventListener('click', function () {
        document.getElementById('edit-reservation-id').value = this.dataset.id;
        document.getElementById('edit-user_id').value = this.dataset.user_id;
        document.getElementById('edit-event_date').value = this.dataset.event_date;
        document.getElementById('edit-nb_places').value = this.dataset.nb_places;
        document.getElementById('editReservationModal').style.display = 'block';
    });
});

function toggleSubmitButton(formId, buttonId) {
    const form = document.getElementById(formId);
    const button = document.getElementById(buttonId);

    if (!form || !form.checkValidity) {
        console.warn(`L'élément avec ID "${formId}" n'est pas un formulaire valide.`);
        return;
    }

    form.addEventListener('input', () => {
        button.disabled = !form.checkValidity();
    });
}
toggleSubmitButton("editReservationForm", "editReservationBtn");
toggleSubmitButton("addReservationForm", "submitReservationBtn");