// Gestion du style des menus
var navlink = document.querySelectorAll('.nav-link');
navlink.forEach(function(element) {
    element.addEventListener("click", function() {
        navlink.forEach(function(activeRemove) {
            activeRemove.classList.remove("active");
        });
        element.classList.add("active");
    });
});
