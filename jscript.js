document.addEventListener("DOMContentLoaded", function() {
    window.onscroll = function() {
        stickyNavbar();
    };

    function stickyNavbar() {
        var navbar = document.querySelector('.navbar');
        var sticky = navbar.offsetTop;

        if (window.pageYOffset >= sticky) {
            navbar.classList.add('fixed-top');
        } else {
            navbar.classList.remove('fixed-top');
        }
    }
});
