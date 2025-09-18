<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$currentPage = explode('/', $_SERVER['REQUEST_URI'])[1];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Etage 13</title>
  <link rel="stylesheet" href="/view/css/styles.css">
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="logo"><a href="/"><img src="/view/medias/images/logo.svg" alt="Logo The Clue Agency" width="100" height="50"></a></div>

      <button class="menu-toggle" id="menu-toggle">&#9776;</button>

      <ul class="nav-links" id="nav-links">
        <li><a href="/"
            class="<?= $currentPage === '' ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="/concept" class="<?= $currentPage === 'concept' ? 'active' : '' ?>">Concept</a></li>
        <li><a href="/info" class="<?= $currentPage === 'info' ? 'active' : '' ?>">Informations
            Pratiques</a></li>

        <?php if (isset($_SESSION['user']['id'])): ?>
          <li><a href="/messagerie" class="<?= $currentPage === 'messagerie' ? 'active' : '' ?>">Messagerie</a></li>
          <li><a href="/profil" class="<?= $currentPage === 'profil' ? 'active' : '' ?>">Profil</a></li>
          <li><a class="auth-button" href="/auth/logout">Déconnexion</a></li>
        <?php else: ?>
          <li><a class="auth-button" href="/auth">Connexion/Inscription</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>