const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector('.theme-toggler');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.removeProperty('display');
});

function setTheme(isDark) {
    document.body.classList.toggle('dark-theme-variables', isDark);

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active', isDark);
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active', !isDark);

    localStorage.setItem('theme', isDark ? 'dark' : 'light');
}

function initTheme() {
    const storedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
        setTheme(true);
    } else {
        setTheme(false);
    }
}

themeToggler.addEventListener('click', () => {
    const isDark = !document.body.classList.contains('dark-theme-variables');
    setTheme(isDark);
});

initTheme();