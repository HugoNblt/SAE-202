<footer>
    <p>&copy; <?= date('Y') ?> - Dashboard</p>
</footer>

<?php if (!empty($_SESSION['flash_message'])): ?>
  <div id="flash-popup" class="popup <?= $_SESSION['flash_message']['type'] ?>">
    <?= htmlspecialchars($_SESSION['flash_message']['text']) ?>
  </div>
  <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>
<script src="/admin/view/js/flash_popup.js"></script>

<?php if (isset($scripts) && is_array($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="/admin/view/js/<?= htmlspecialchars($script) ?>"></script>

    <?php endforeach; ?>
<?php endif; ?>
<script src="/admin/view/js/script.js"></script>
</body>

</html>