<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="login-container">
    <form class="login-form" method="post" action="/gestion/auth">
      <h2>Connexion Admin</h2>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="admin@example.com" required />
      </div>
      <div class="input-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required />
      </div>
      <button type="submit" class="btn-login">Se connecter</button>
      <div class="btn-site">
        <a href="/">Retourner au site</a>
      </div>
    </form>
  </div>