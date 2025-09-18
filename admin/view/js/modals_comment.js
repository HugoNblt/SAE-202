document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById("commentModal");
    const closeBtn = document.getElementById("closeCommentModal");

    document.querySelectorAll('a[data-isPublished]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const row = link.closest('tr');
            const commentId = row.querySelector('td').textContent.trim();
            const content = row.querySelectorAll('td')[2].innerText.trim();
            const isPublished = link.dataset.isPublished === "1" ? "1" : "0";

            document.getElementById('comment_id').value = commentId;
            document.getElementById('comment_content').value = content;
            document.getElementById('new_status').value = isPublished;

            modal.style.display = "flex";
        });
    });

    closeBtn.onclick = () => modal.style.display = "none";

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    document.querySelectorAll('.delete-comment-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const commentId = this.dataset.id;
            const confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer ce commentaire ?");

            if (confirmDelete) {
                window.location.href = `/gestion/delete_comment?id=${commentId}`;
            }
        });
    });
});