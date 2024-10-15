jQuery(function ($) {
    "use strict";

    //preloader
    $(window).on("load", function () {
        setTimeout(function () {
            $("#preloader").fadeOut("slow", function () {
                $(this).remove();
            });
        }, 500);
    });
});
