$(document).ready(function(){

    var $thisModule = $('.wpx-mc19972a5');


    $thisModule.each(function(){

        $(this).css('opacity', 1);

        $(this).find('.slick-container').slick({
            arrows:false,
            dots: false,
            infinite: true,
            speed: 1000,
            slidesToShow: 6,
            slidesToScroll: 6,
            autoplay: true,
            autoplaySpeed: 4000,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });

    });
});