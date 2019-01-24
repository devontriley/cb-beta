import './../../node_modules/slick-carousel/slick/slick.js';

$(document).ready(function() {

    const slider = document.querySelector('.image-carousel__images');

    if(slider)
    {
        const slickSlider = $(slider).slick({
            arrows: false,
            dots: false
        });
    }

});