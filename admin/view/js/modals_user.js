document.getElementById("openModal").onclick = function() {
    document.getElementById("userModal").style.display = "block";
}

document.getElementById("closeModal").onclick = function() {
    document.getElementById("userModal").style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById("userModal")) {
        document.getElementById("userModal").style.display = "none";
    }
}

const form = document.querySelector('#userModal form');
const submitBtn = document.getElementById('submitBtn');

function validateForm() {
    const inputs = form.querySelectorAll('input[required], select[required]');
    let valid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            valid = false;
        }
    });

    submitBtn.disabled = !valid;
}

form.querySelectorAll('input[required], select[required]').forEach(input => {
    input.addEventListener('input', validateForm);
    input.addEventListener('change', validateForm);
});

const editModal = document.getElementById("editModal");
const closeEditModal = document.getElementById("closeEditModal");
const editForm = document.getElementById("editForm");
const editBtn = document.getElementById("editSubmitBtn");

function validateEditForm() {
    const inputs = editForm.querySelectorAll('input[required], select[required]');
    let valid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            valid = false;
        }
    });

    editBtn.disabled = !valid;
}

document.querySelectorAll('.edit-user-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-last_name').value = this.dataset.last_name;
        document.getElementById('edit-first_name').value = this.dataset.first_name;
        document.getElementById('edit-email').value = this.dataset.email;
        document.getElementById('edit-phone').value = this.dataset.phone;
        document.getElementById('edit-birth_date').value = this.dataset.birth_date;
        document.getElementById('edit-role').value = this.dataset.role;

        validateEditForm();

        editModal.style.display = "block";
    });
});

closeEditModal.onclick = function() {
    editModal.style.display = "none";
};

window.onclick = function(event) {
    if (event.target == editModal) {
        editModal.style.display = "none";
    }
};

editForm.querySelectorAll('input[required], select[required]').forEach(input => {
    input.addEventListener('input', validateEditForm);
    input.addEventListener('change', validateEditForm);
});

document.querySelectorAll('.delete-user-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const userId = this.dataset.id;

        if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.")) {
            window.location.href = "/gestion/delete_user?id=" + userId;
        }
    });
});