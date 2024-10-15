jQuery(function ($) {
    "use strict";



    $(window).on("scroll", function () {
        var scrollBarPosition = $(window).scrollTop();
        $(".tt-vertical-step ul li a").each(function () {
            var navOffset = $(this.hash).offset().top - 90;
            if (scrollBarPosition > navOffset) {
                $(this).parents("ul").find("a.active").removeClass("active");
                $(this).addClass("active");
            }
        });
    });
    $(".tt-vertical-step ul li a").each(function () {
        $(this).on("click", function (e) {
            e.preventDefault();
            var hashOffset = $(this.hash).offset().top - 85;
            $("body,html").animate(
                {
                    scrollTop: hashOffset,
                },
                500
            );
        });
    });
});
