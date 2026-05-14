/* =============================================
   BlogHub - Admin Panel JavaScript (admin.js)
   ============================================= */

$(document).ready(function () {

    // ==========================================
    // MOBILE SIDEBAR TOGGLE
    // ==========================================
    $('#sidebarToggle').on('click', function () {
        $('#adminSidebar').addClass('open');
        $('#sidebarOverlay').addClass('open');
        $('body').css('overflow', 'hidden');
    });

    function closeSidebar() {
        $('#adminSidebar').removeClass('open');
        $('#sidebarOverlay').removeClass('open');
        $('body').css('overflow', '');
    }

    $('#sidebarClose, #sidebarOverlay').on('click', closeSidebar);

    // Auto-dismiss alerts after 4 seconds
    setTimeout(function () {
        $('.alert.fade.show').each(function () {
            const alert = bootstrap.Alert.getOrCreateInstance(this);
            alert.close();
        });
    }, 4000);

});
