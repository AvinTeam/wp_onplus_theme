

document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggleTheme');
    const themeIcon = document.getElementById('themeIcon');
    const logoLight = document.getElementById('logo-light');
    const logoDark = document.getElementById('logo-dark');
    const savedTheme = localStorage.getItem('theme') || 'light';
    if (savedTheme == 'dark') {
        logoDark.classList.add('d-none')
    } else {
        logoLight.classList.add('d-none')
    }
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
    themeIcon.className = savedTheme === 'light' ? 'bi bi-sun' : 'bi bi-moon';
    toggleButton.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-bs-theme', newTheme);
        themeIcon.className = newTheme === 'light' ? 'bi bi-sun' : 'bi bi-moon';
        localStorage.setItem('theme', newTheme);
        logoDark.classList.remove('d-none');
        logoLight.classList.remove('d-none');
        if (newTheme == 'dark') {
            logoDark.classList.add('d-none');
        } else {
            logoLight.classList.add('d-none');
        }
    });
});

function openSearch() {
    document.getElementById('fullscreenSearch').style.display = 'flex';
}

function closeSearch() {
    document.getElementById('fullscreenSearch').style.display = 'none';
}

// بستن جستجو با زدن دکمه Escape
document.addEventListener('keydown', function (event) {
    if (event.key === "Escape") {
        closeSearch();
    }
});