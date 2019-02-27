const mainHeader = document.querySelector('.main-header');

if(mainHeader)
{
    let previousScroll = 0;
    let last_known_scroll_position;
    let ticking = false;

    function updateHeader(scroll_pos)
    {
        if(scroll_pos !== previousScroll)
        {
            if(scroll_pos > previousScroll)
            {
                // down
                mainHeader.classList.remove('show');

                if(scroll_pos > mainHeader.clientHeight)
                {
                    mainHeader.classList.add('main-header--scroll-up');
                } else {
                    mainHeader.classList.remove('main-header--scroll-up');
                }
            }
            else
            {
                // up
                if(scroll_pos > 0)
                {
                    mainHeader.classList.add('show');
                } else {
                    mainHeader.classList.remove('main-header--scroll-up');
                    mainHeader.classList.remove('show');
                }
            }
            previousScroll = scroll_pos;
        }
    }

    window.addEventListener('scroll', function(e)
    {
        last_known_scroll_position = window.pageYOffset;

        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateHeader(last_known_scroll_position);
                ticking = false;
            });

            ticking = true;
        }
    });
}