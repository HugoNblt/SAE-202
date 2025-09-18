<form action="/profil/update" method="post" class="profile-form">
    <h2>Modifier mon profil</h2>

    <label>Prénom</label>
    <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

    <label>Nom</label>
    <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

    <label>Pseudo</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>">

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Téléphone</label>
    <input type="tel" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">

    <label>Adresse</label>
    <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>">

    <label>Ville</label>
    <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>">

    <label>Pays</label>
    <input type="text" name="country" value="<?= htmlspecialchars($user['country']) ?>">

    <label>Code Postal</label>
    <input type="text" name="postal_code" value="<?= htmlspecialchars($user['postal_code']) ?>">

    <label>Date de naissance</label>
    <input type="date" name="birth_date" value="<?= htmlspecialchars($user['birth_date']) ?>">

    <button type="submit">Enregistrer les modifications</button>
</form>