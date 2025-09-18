document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.delete-message').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const messageId = this.dataset.id;
            const confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer ce message ?");

            if (confirmDelete) {
                window.location.href = `/gestion/delete_message?id=${messageId}`;
            }
        });
    });
});