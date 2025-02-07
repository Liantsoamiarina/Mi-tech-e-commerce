// Gestion du style des menus
function setActiveLink () {
    const currentUrl = window.location.href;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link=> {
        link.classList.remove('active');
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        }
    });
}

setActiveLink();
window.addEventListener('popstate', setActiveLink);