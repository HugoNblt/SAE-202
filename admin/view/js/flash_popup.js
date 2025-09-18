const flashPopup = document.getElementById('flash-popup');
if (flashPopup) {
  setTimeout(() => {
    flashPopup.style.opacity = '0';
    setTimeout(() => flashPopup.remove(), 500);
  }, 3000);
}