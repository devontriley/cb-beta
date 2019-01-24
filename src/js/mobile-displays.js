import './../../node_modules/slick-carousel/slick/slick.js';

if(!window.matchMedia('(min-width: 768px)').matches)
{
    $(document).ready(function () {
        const slider = document.querySelector('.mobile-displays__images');

        if (slider) {
            const quoteSlider = $(slider).slick({
                'arrows': false,
                'dots': false,
                'infinite': true
            });
            const prev = document.querySelector('.quote-slider__prev');
            const next = document.querySelector('.quote-slider__next');

            $(prev).on('click', function () {
                $(quoteSlider).slick('slickPrev');
            });

            $(next).on('click', function () {
                $(quoteSlider).slick('slickNext');
            });
        }
    });
}