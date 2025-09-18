const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.getElementById('nav-links');

menuToggle.addEventListener('click', () => {
  const isOpen = navLinks.classList.toggle('open');
  menuToggle.classList.toggle('open');
  menuToggle.innerHTML = isOpen ? '✖' : '&#9776;';
});

document.querySelectorAll('.nav-links a').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth < 768) {
      navLinks.classList.remove('open');
      menuToggle.classList.remove('open');
      menuToggle.innerHTML = '&#9776;';
    }
  });
});

function showregister() {
  const login = document.getElementById("login-container");
  const signup = document.getElementById("signup-container");
  login.style.display = "none";
  signup.style.display = "flex";
};

function showlogin() {
  const login = document.getElementById("login-container");
  const signup = document.getElementById("signup-container");
  login.style.display = "flex";
  signup.style.display = "none";
};