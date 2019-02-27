import {getElementIndex} from "./utils";

const locationsModule = document.querySelector('.locations');

if(locationsModule)
{
    const locations = locationsModule.querySelector('.locations__locations-container');
    const images = locationsModule.querySelectorAll('.locations__image img');
    let active = 0;


    locations.addEventListener('mouseover', function(e)
    {
        const li = e.target.closest('.locations__location');
        if(li == null) return;
        const index = getElementIndex(li);

        images[active].style.display = 'none';
        images[index].style.display = 'block';

        active = index;
    });
}