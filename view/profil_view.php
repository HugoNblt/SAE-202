<div class="container-profil">
    <!-- Bannière -->
    <?php if (!empty($user['banner'])): ?>
        <div class="banner-profil">
            <img src="<?= htmlspecialchars($user['banner']) ?>" class="banner-image" alt="Bannière">
        </div>
    <?php else: ?>
        <div class="banner-profil default-banner"></div>
    <?php endif; ?>

    <div class="profil-header">
        <?php
        $avatar = !empty($user['avatar']) ? htmlspecialchars($user['avatar']) : '/view/medias/images/default-avatar.png';
        ?>
        <img src="<?= $avatar ?>" alt="Avatar" class="avatar-profil">
        <div class="profil-nom"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></div>
        <div class="profil-username">@<?= htmlspecialchars($user['username']) ?></div>
    </div>

    <!-- Infos -->
    <div class="profil-info">
        <div><span class="text-label">Email:</span> <?= htmlspecialchars($user['email']) ?></div>
        <div><span class="text-label">Téléphone:</span> <?= htmlspecialchars($user['phone']) ?></div>
        <div><span class="text-label">Ville:</span> <?= htmlspecialchars($user['city']) ?></div>
        <div><span class="text-label">Pays:</span> <?= htmlspecialchars($user['country']) ?></div>
        <div><span class="text-label">Date de naissance:</span> <?= htmlspecialchars($user['birth_date']) ?>
        </div>
        <div><span class="text-label">Rôle:</span> <?= htmlspecialchars($user['role']) ?></div>
    </div>

    <div class="btn-profil">
        <button class="btn-edit-profil" onclick="openModal()">Modifier le profil</button>
    </div>
</div>
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form action="/profil/update" method="post" class="form-edit-profil">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

            <label>Prénom</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

            <label>Nom</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label>Ville</label>
            <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>">

            <label>Pays</label>
            <input type="text" name="country" value="<?= htmlspecialchars($user['country']) ?>">

            <label>Téléphone</label>
            <input type="tel" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
            <label>Date de naissance</label>
            <input type="date" name="birth_date" value="<?= htmlspecialchars($user['birth_date']) ?>">
            <div>
                <button type="submit" class="btn-edit-profil">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnOpen = document.querySelector('.btn-edit-profil');
        const modal = document.getElementById('editModal');
        const btnClose = modal.querySelector('.close');

        function openModal() {
            modal.style.display = 'flex';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        btnOpen.addEventListener('click', openModal);
        btnClose.addEventListener('click', closeModal);

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    });
</script>