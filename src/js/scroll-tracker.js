import { round, ease } from './utils.js';

window.onload = function()
{
    const body = document.body;
    const documentHeight = body.offsetHeight;
    const windowHeight = window.innerHeight;
    const isMobile = !window.matchMedia('(min-width: 768px)').matches;

    let scrollTrackerFill = document.querySelector('.scroll-tracker__fill');
    let scrollTrackerText = document.querySelector('.scroll-tracker__scroll-text');
    let svg = scrollTrackerText.querySelector('svg');
    let text = scrollTrackerText.querySelector('span');
    let last_known_scroll_position = 0;
    let ticking = false;
    let startingFill = getFillAmount(0.001);

    body.addEventListener('click', (e) =>
    {
        if(e.target.closest('.to-top'))
        {
            window.requestAnimationFrame(smoothScroll);
        }
    });

    setFillAmount(startingFill);

    let start = null;
    let duration = 1000;

    function smoothScroll(timestamp)
    {
        if(!start) start = timestamp;
        let progress = timestamp - start;
        let easedPosition = documentHeight - ease('easeOutCubic', 0, progress, 0, documentHeight, duration);

        window.scrollTo(0, easedPosition);

        if(progress < duration)
        {
            window.requestAnimationFrame(smoothScroll);
        }
        else
        {
            start = null;
        }
    }

    function getFillAmount(scroll_pos)
    {
        let distance = ((scroll_pos + windowHeight) / documentHeight) * 100;

        return distance;
    }

    function setFillAmount(distance)
    {
        if(isMobile)
        {
            scrollTrackerFill.style.width = distance + '%';
        }
        else
        {
            scrollTrackerFill.style.height = distance + '%';
        }
    }

    function handleScrollText(scroll_pos)
    {
        if(scroll_pos == 0)
        {
            scrollTrackerText.classList.remove('to-top');
            text.innerText = 'scroll down';
            $(svg).removeClass('up');
            // svg.classList.remove('up');
            scrollTrackerText.style.opacity = '1';
            return;
        }

        if((last_known_scroll_position + windowHeight) >= documentHeight)
        {
            text.innerText = 'back to top';
            $(svg).addClass('up');
            scrollTrackerText.classList.add('to-top');
            scrollTrackerText.style.opacity = '1';
            return;
        }

        scrollTrackerText.style.opacity = 0;
    }

    function scrollEvent()
    {
        last_known_scroll_position = window.pageYOffset;

        handleScrollText(last_known_scroll_position);

        if(!ticking)
        {
            window.requestAnimationFrame(function()
            {
                setFillAmount(getFillAmount(last_known_scroll_position));
                ticking = false;
            });

            ticking = true;
        }
    }

    window.addEventListener('scroll', scrollEvent);
}