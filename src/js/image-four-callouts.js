import './../../node_modules/slick-carousel/slick/slick.js';
import { getElementIndex } from './utils.js';

const imageFourCallouts = document.querySelector('.image-four-callouts');

if(imageFourCallouts)
{
    let active = 0;
    const imageFourCalloutsSlick = document.querySelector('.image-four-callouts__callouts');
    const images = imageFourCallouts.querySelectorAll('.image-four-callouts__image img');
    const callouts = imageFourCallouts.querySelectorAll('.image-four-callouts__callouts li');
    const prev = imageFourCallouts.querySelector('.prev');
    const next = imageFourCallouts.querySelector('.next');

    if(!window.matchMedia('(min-width: 768px)').matches)
    {
        $(imageFourCalloutsSlick).slick({
            'dots': true,
            'arrows': false
        });

        $(imageFourCallouts).on('beforeChange', (e, slick, currentSlide, nextSlide) =>
        {
            images[active].style.display = 'none';
            images[nextSlide].style.display = 'block';
            active = nextSlide;
        });

        prev.addEventListener('click', (e) =>
        {
            $(imageFourCalloutsSlick).slick('slickPrev');
        });

        next.addEventListener('click', (e) =>
        {
            $(imageFourCalloutsSlick).slick('slickNext');
        });
    }
    else
    {
        imageFourCallouts.addEventListener('mouseover', function(e)
        {
            const li = e.target.closest('li');
            if(li == null) return;
            const index = getElementIndex(li);

            for(let i = 0; i < callouts.length; i++)
            {
                callouts[i].classList.remove('active');
            }
            images[active].style.display = 'none';
            li.classList.add('active');
            images[index].style.display = 'block';

            active = index;
        });
    }
}