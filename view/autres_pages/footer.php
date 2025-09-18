<footer class="footer">
  <div class="footer-top">
    <p class="footer-heading">L’affaire est ouverte. Le Grand Hôtel vous attend.</p>
    <a href="" class="footer-btn">Réservez dès maintenant</a>
  </div>

  <hr>

  <div class="footer-links">
    <div class="footer-social">
      <p><strong>Suivez-nous :</strong></p>
      <div class="social-icons">
        <a href="#"><img src="/view/medias/images/insta.svg" alt="Instagram" /></a>
        <a href="#"><img src="/view/medias/images/tiktok.svg" alt="TikTok" /></a>
      </div>
    </div>

    <ul class="footer-columns">
      <li><a href="/info">Informations Pratiques</a></li>
      <li><a href="/contact">Contactez-nous</a></li>
      <li><a href="">Accès</a></li>
    </ul>

    <ul class="footer-columns">
      <li><a href="/mention">Mentions Légales</a></li>
      <li><a href="">Confidentialité</a></li>
      <li><a href="">Accessibilité</a></li>
    </ul>

    <ul class="footer-columns">
      <li><a href="/gestion">Administrateurs</a></li>
      <li><a href="">Crédits</a></li>
      <li><a href="/agence">L’agence</a></li>
    </ul>
  </div>

  <p class="footer-bottom">© 2025 Murder Party Étage 13 - Tous droits réservés</p>
</footer>
<?php if (isset($scripts) && is_array($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="/view/js/<?= htmlspecialchars($script) ?>"></script>

    <?php endforeach; ?>
<?php endif; ?>
<script src="/view/js/script.js" defer></script>
</body>

</html>