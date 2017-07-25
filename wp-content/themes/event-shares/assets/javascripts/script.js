jQuery(function ($) {

    /**
     * Always use '$name' style for variable which contains jQuery element.
     * Cache often used DOM elements in variable.
     */
    //$window = $( window );
    //$htmlBody = $( "html, body" );
    var $window = $(window);
    var $document = $(document);
    var $body = $("body");
    /**
     * Add/remove class on scroll
     **/
    var $wpgMainHeader = $("#wpx-eventshare-header");

    var sizeBar = function () {
        if ($window.scrollTop() > 400) {
            $wpgMainHeader.addClass("wpx-small-header");
        } else {
            $wpgMainHeader.removeClass("wpx-small-header");
        }
    };




    var mobileVer = function () {
        if ($(".wpx-button-hamburger").css("display") === "block") {
            $body.addClass("wpg-mobile").removeClass("wpx-desktop");
        } else {
            $body.removeClass("wpg-mobile").addClass("wpx-desktop");
        }
    };




    mobileVer();
    $window.on("resize", mobileVer);
    $window.on("scroll", sizeBar);



    /* mobile hamburger */
    (function ($) {


        var sizeBar = function () {
            if ($window.scrollTop() > 100) {
                $wpgMainHeader.addClass("wpx-small-header");
            } else {
                $wpgMainHeader.removeClass("wpx-small-header");
            }
        };


        $(".wpx-button-hamburger").on("click", function (event) {
            event.preventDefault();
            $wpgMainHeader
                .toggleClass("wpx-active-mobile-menu-parent")
                .find("nav")
                .toggleClass("wpx-active-mobile-menu");

        });

        $window.on("resize", mobileVer);
        $window.on("load", mobileVer);
        $window.on("scroll", sizeBar);
        //close mobile menu

        // $document.on("click", "body", function (e) {
        //     if ($wpgMainHeader.hasClass("wpx-active-mobile-menu-parent")) {
        //         if ($(e.target).is('.wpx-main-header *')) {
        //             return;
        //         } else {
        //             $(".wpx-button-hamburger").trigger("click");
        //         }
        //     }
        // });
        // $body.on("swiperight", function () {
        //     if ($wpgMainHeader.hasClass("wpx-active-mobile-menu-parent")) {
        //         $(".wpx-button-hamburger").trigger("click");
        //
        //     }
        // });

    })(jQuery);

    $('#sign-up-link').on('click', function() {

        $('#subscribe-modal').removeClass('fade');

    });

    function subscribers() {

        $('#subscribe-submit').on('click', function() {

            var email = $('#subscribe-email').val(),
                investor = $('#subscribe-select').find('option:selected').val();

            if(email !== '') {

                var data = {
                    action: 'sendToSubscribe',
                    email: email,
                    investor: investor
                };

                $.ajax({
                    type: 'post',
                    url: Ajax.ajax_url,
                    data: data
                }).done( function( response ) {

                })
            }

        });
    }

    subscribers();

});