import { getElementIndex } from './utils.js';
import './../../node_modules/slick-carousel/slick/slick.js';

$(document).ready(function() {

    const slider = document.querySelector('.image-carousel__images');
    const nav = document.querySelector('.image-carousel__nav');

    if(slider)
    {
        $(slider).slick({
            arrows: false,
            dots: false
        });

        $(slider).on('beforeChange', function(e, slick, currentSlide, nextSlide)
        {
            updateNav(nextSlide);
        });

        nav.addEventListener('click', function(e)
        {
            e.preventDefault();
            changeNav(e);
        });
    }

    function changeNav(e)
    {
        let li = e.target.closest('li');

        if(li)
        {
            let index = getElementIndex(li);
            console.log(index);
            $(slider).slick('slickGoTo', index);
        }
    }

    function updateNav(nextSlide)
    {
        nav.querySelector('.active').classList.remove('active');
        nav.querySelectorAll('li')[nextSlide].classList.add('active');
    }

});