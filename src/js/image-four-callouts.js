import './../../node_modules/slick-carousel/slick/slick.js';
import { getElementIndex } from './utils.js';

const imageFourCallouts = document.querySelector('.image-four-callouts');

if(imageFourCallouts)
{
    let active = 0;
    const imageFourCalloutsSlick = document.querySelector('.image-four-callouts__callouts');
    const images = imageFourCallouts.querySelectorAll('.image-four-callouts__image img');

    if(!window.matchMedia('(min-width: 768px)').matches)
    {
        $(imageFourCalloutsSlick).slick({
            'dots': true,
        });

        $(imageFourCallouts).on('beforeChange', function(e, slick, currentSlide, nextSlide)
        {
            images[active].style.display = 'none';
            images[nextSlide].style.display = 'block';
            active = nextSlide;
        });
    }
    else
    {
        imageFourCallouts.addEventListener('mouseover', function(e)
        {
            const li = e.target.closest('li');
            if(li == null) return;
            const index = getElementIndex(li);

            images[active].style.display = 'none';
            images[index].style.display = 'block';

            active = index;
        });
    }
}