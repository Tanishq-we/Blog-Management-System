/* =============================================
   BlogHub - Frontend JavaScript
   ============================================= */

$(document).ready(function () {

    // ==========================================
    // NAVBAR SCROLL EFFECT
    // ==========================================
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 50) {
            $('#mainNavbar').addClass('scrolled');
            $('#scrollToTop').addClass('visible');
        } else {
            $('#mainNavbar').removeClass('scrolled');
            $('#scrollToTop').removeClass('visible');
        }
    });

    // ==========================================
    // SCROLL TO TOP
    // ==========================================
    $('#scrollToTop').on('click', function () {
        $('html, body').animate({ scrollTop: 0 }, 400);
    });

});
