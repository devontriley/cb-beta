import { getElementIndex } from './utils.js';

const imageGrid = document.querySelector('.image-grid');

if(imageGrid)
{
    const images = imageGrid.querySelectorAll('.image-grid__image');
    let active = [];
    for(let i = 0; i < images.length; i++)
    {
        active[i] = 0;
    }

    loopImages();

    let last = 0;
    function loopImages(now)
    {
        // Fire every 2 seconds
        if(now - last >= 2000)
        {
            last = now;
            for(let i = 0; i < images.length; i++)
            {
                if(images[i].children.length == 1) continue;

                let next = (active[i] < images[i].children.length - 1) ? active[i] + 1 : 0;

                images[i].children[active[i]].style.display = 'none';
                images[i].children[next].style.display = 'block';
                active[i] = next;
            }
        }
        window.requestAnimationFrame(loopImages);
    }
}