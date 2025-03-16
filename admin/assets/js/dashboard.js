document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
        if (window.innerWidth > 768) {
            if (sidebar.classList.contains('open')) {
                mainContent.classList.toggle('open');
            } else {
                mainContent.classList.remove('open');
            }
        }
    });

    closeMenu.addEventListener('click', function() {
        sidebar.classList.remove('open');
        if (window.innerWidth > 768) {
            mainContent.classList.remove('open');
        }
    });
});