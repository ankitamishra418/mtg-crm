function checkDataTable() {
    if ($.fn.DataTable.isDataTable('#DataTables_Table_0')) {
        var userid = $("#userid").html();
        if (userid != 16 || userid != 101 || userid != 108) {
            $(".btn-group button.buttons-collection").css("display", 'none');
            $(".btn-group > :nth-child(3)").css("display", 'none');
            $("#schedulebtn").css("display", 'none');
            $(".buttons-excel").css("display", 'none');
            $(".buttons-csv").css("display", 'none');
        }
    } else {
        setTimeout(checkDataTable, 10);
    }
}
// function chooseDataTable() {
//     if ($.fn.DataTable.isDataTable('#choose_contact_table')) {
//         var userid = $("#userid").html();
//         if (userid != 16 || userid != 101 || userid != 108) {
//             $(".buttons-excel").css("display", 'none');
//             $(".buttons-csv").css("display", 'none');
//         }
//     } else {
//         setTimeout(chooseDataTable, 10);
//     }
// }
$(window).on('load', function () {
    checkDataTable();
    // chooseDataTable()
});
(function($) {
    "use strict";

    // Changed some elements with new animation
    var slowFadeIn = 'animated fadeIn';
    $('body').addClass('perfex_office_theme_initiated');
    $('.screen-options-area').addClass(slowFadeIn);
    $('#mobile-collapse').addClass(slowFadeIn);

    $('.quick-links').prependTo('#header nav .navbar-nav');

    $('.quick-links').css('display', 'block');

    $('li:has(a.close-customizer)').css({
        'background': '#566de2',
        'height': '62px'
    });

    // Add butons wave effects
    Waves.init();
    Waves.attach('.btn', ['waves-effect', 'waves-light', 'waves-ripple']);

    // Change chart default font color
    Chart.defaults.global.defaultFontColor = "#000000";
    // Ini nanobar
    var options = {
        target: document.getElementsByTagName("BODY")[0]
    };

    var nanobar = new Nanobar(options);
    if (document.readyState == 'loading') {
        nanobar.go(30);
        nanobar.go(76);
        nanobar.go(100);
    }


})(jQuery);