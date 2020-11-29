jQuery(document).ready(function ($) {
    function sitescroll () {
        $.scrollify({
            section: ".ace-section",
            easing: "easeOutExpo",
            scrollSpeed: 1000,
            scrollbars: true,
            setHeights: false,
            overflowScroll: true,
            updateHash: false,
            touchScroll: true,
            // before: function (position, element) {
            //     if (position === 0) {
            //         element[0].css({ "margin-top": "90px" });
            //     }
            //     if (position > 0) {
            //         element[0].css({ "margin-top": "0" });
            //     }
            // },
            afterRender: function () {
                $($(this.section)[0]).css({ "margin-top": "90px" });
            },
        });
        if(window.matchMedia("(max-width: 767px)").matches) {
            $.scrollify.destroy();
            var navbarHeight = $(".ace-header").outerHeight();          
            $($(".ace-section")[0]).css({ "margin-top": navbarHeight });
        } 
    }
    // sitescroll();   
});
(function () {
    // Back to top
    jQuery(".back-to-top").on("click", function () {
        jQuery("html, body").animate({ scrollTop: 0 }, 500);
        return false;
    });

    //Get Element Position
    var elementPosition = function (idClass) {
        var element = jQuery(idClass);
        var offset = element.offset();
        return {
            top: offset.top,
            right: offset.left + element.outerWidth(),
            bottom: offset.top + element.outerHeight(),
            // bottom: element.position().top + element.outerHeight(true),
            left: offset.left,
        };
    };

    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarElement = jQuery(".ace-top-header");
    var navbarHeight = navbarElement.outerHeight();

    jQuery(window).scroll(function (event) {
        didScroll = true;
    });

    function hasScrolled() {
        var st = jQuery(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta) return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            navbarElement.removeClass("nav-down").addClass("nav-up");
        } else {
            // Scroll Up
            if (st + jQuery(window).height() < jQuery(document).height()) {
                navbarElement.removeClass("nav-up").addClass("nav-down");
            }
        }
        lastScrollTop = st;
    }

    setInterval(function () {
        if (didScroll) {
            //hasScrolled();
            didScroll = false;
        }
    }, 250);
})(jQuery);
