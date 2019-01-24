import './../../node_modules/slick-carousel/slick/slick.js';

$(document).ready(function()
{
    const slider = document.querySelector('.quote-slider__slider');

    if(slider)
    {
        const quoteSlider = $(slider).slick({
            'arrows': false,
            'dots': false
        });
        const prev = document.querySelector('.quote-slider__prev');
        const next = document.querySelector('.quote-slider__next');

        $(prev).on('click', function(){
            $(quoteSlider).slick('slickPrev');
        });

        $(next).on('click', function(){
            $(quoteSlider).slick('slickNext');
        });
    }
});