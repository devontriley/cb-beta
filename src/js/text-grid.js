import './../../node_modules/slick-carousel/slick/slick.js';

$(document).ready(function(){

    // TODO: Load/destroy slider on window resize

    const textBlocks = document.querySelector('.text-grid__blocks');
    let slickTextBlocks;

    if(mobileDetected)
    {
        if(textBlocks)
        {
            slickTextBlocks = $(textBlocks).slick({
                'infinite': false,
                'variableWidth': true,
                'arrows': false,
                'dots': false
            });

            slickTextBlocks.on('beforeChange', function(e, slick, currentSlide, nextSlide){
                let newHandlePos = nextSlide * ((dragNavW - handleWidth) / (slideCount - 1));
                handle.style.left = newHandlePos + 'px';
            });

            // Drag Nav
            const dragNav = document.querySelector('.text-grid__drag-nav');
            const dragNavW = dragNav.offsetWidth;

            // Slider
            let slideCount = textBlocks.slick.slideCount;
            let slickTrack = document.querySelector('.text-grid .slick-track');
            let trackXPos = setSlickTrackPosition();
            let slickSlides = document.querySelectorAll('.text-grid .slick-slide');
            let slidesW = getTotalSlideWidth(slickSlides);

            // Handle
            let handle = document.querySelector('.text-grid__drag-handle');
            let handleXPos = parseInt(window.getComputedStyle(handle).left);
            let handleWidth = handle.offsetWidth;
            let touchStartX = null;
            let touchDifference = 0;

            handle.addEventListener("touchstart", handleStart, false);
            handle.addEventListener("touchend", handleEnd, false);
            handle.addEventListener("touchmove", handleMove, false);

            function getTotalSlideWidth(slides) {
                let w = 0;
                for(let i = 0; i < $(slides).length; i++)
                {
                    w += slides[i].offsetWidth;
                }
                return w;
            }

            function setSlickTrackPosition() {
                let transformStyle = slickTrack.style.transform;
                let regExp = /\(([^)]+)\)/;
                let matches = regExp.exec(transformStyle);

                return parseInt(matches[1].split(',')[0]);
            }

            function handleStart(e)
            {
                handle.classList.add('clicked');

                // Track touch start position
                touchStartX = e.touches[0].clientX;
            }

            function handleMove(e)
            {
                // Track amount moved since touchstart
                touchDifference = e.touches[0].clientX - touchStartX;

                // Move handle
                let handleX = touchDifference + handleXPos;
                if(handleX < 0) handleX = 0;
                if(handleX + handleWidth > dragNavW) handleX = dragNavW - handleWidth;
                handle.style.left = handleX + 'px';

                // Get slick track position
                let newTrackX = -handleX * (slidesW / dragNavW);
                trackXPos = newTrackX;

                $(slickTrack).css({
                    'transform': 'translate3d('+newTrackX+'px, 0px, 0px)'
                });
            }

            function handleEnd(e)
            {
                handle.classList.remove('clicked');

                // Update handle position reference
                handleXPos = parseInt(window.getComputedStyle(handle).left);

                // Update track position reference
                trackXPos = setSlickTrackPosition();

                // Go to nearest slide
                let oldRange = dragNavW - handleWidth;
                let newMin = 0;
                let newMax = 100;
                let newRange = newMax - newMin;
                let newSlidePercentage = ((((handleXPos + handleWidth) - handleWidth) * newRange) / oldRange) + newMin;
                let newSlideIndex = newSlidePercentage / (100 / slideCount);

                for(var i = 0; i < slideCount; i++)
                {
                    let val = newSlideIndex - i;

                    if(val > 0 && val < 1)
                    {
                        // Go to slide
                        slickTextBlocks.slick('slickGoTo', i);

                        // Update handle position & reference
                        let newHandlePos = i * ((dragNavW - handleWidth) / (slideCount - 1));
                        handle.style.left = newHandlePos + 'px';
                        handleXPos = parseInt(handle.style.left);
                    }
                }
            }
        }
    }
});