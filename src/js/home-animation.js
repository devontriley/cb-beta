import { ease, getElementIndex } from './utils.js';
import './../../node_modules/svgjs/dist/svg.js';

// creates a global "addWheelListener" method
// example: addWheelListener( elem, function( e ) { console.log( e.deltaY ); e.preventDefault(); } );
(function(window, document) {

    var prefix = "", _addEventListener, support;

    // detect event model
    if ( window.addEventListener ) {
        _addEventListener = "addEventListener";
    } else {
        _addEventListener = "attachEvent";
        prefix = "on";
    }

    // detect available wheel event
    support = "onwheel" in document.createElement("div") ? "wheel" : // Modern browsers support "wheel"
        document.onmousewheel !== undefined ? "mousewheel" : // Webkit and IE support at least "mousewheel"
            "DOMMouseScroll"; // let's assume that remaining browsers are older Firefox

    window.addWheelListener = function( elem, callback, useCapture ) {
        _addWheelListener( elem, support, callback, useCapture );

        // handle MozMousePixelScroll in older Firefox
        if( support == "DOMMouseScroll" ) {
            _addWheelListener( elem, "MozMousePixelScroll", callback, useCapture );
        }
    };

    function _addWheelListener( elem, eventName, callback, useCapture ) {
        elem[ _addEventListener ]( prefix + eventName, support == "wheel" ? callback : function( originalEvent ) {
            !originalEvent && ( originalEvent = window.event );

            // create a normalized event object
            var event = {
                // keep a ref to the original event object
                originalEvent: originalEvent,
                target: originalEvent.target || originalEvent.srcElement,
                type: "wheel",
                deltaMode: originalEvent.type == "MozMousePixelScroll" ? 0 : 1,
                deltaX: 0,
                deltaY: 0,
                deltaZ: 0,
                preventDefault: function() {
                    originalEvent.preventDefault ?
                        originalEvent.preventDefault() :
                        originalEvent.returnValue = false;
                }
            };

            // calculate deltaY (and deltaX) according to the event
            if ( support == "mousewheel" ) {
                event.deltaY = - 1/40 * originalEvent.wheelDelta;
                // Webkit also support wheelDeltaX
                originalEvent.wheelDeltaX && ( event.deltaX = - 1/40 * originalEvent.wheelDeltaX );
            } else {
                event.deltaY = originalEvent.deltaY || originalEvent.detail;
            }

            // it's time to fire the callback
            return callback( event );

        }, useCapture || false );
    }

})(window,document);

$(document).ready(function()
{
    let stage = document.getElementById('animation');
    let isMobile = window.matchMedia('(max-width: 767px').matches;

    if(stage) {
        //let headersContainer = document.querySelector('#animation .headers');
        let mainH1 = document.querySelector('#animation > h1');
        let headers = document.querySelectorAll('h1 .header');
        let copy = document.querySelectorAll('.copy-container .copy');
        let dots = document.querySelectorAll('#animation-dots li');
        let headerDim = {w: 0, h: 0};
        let maxHeaderWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0) * .25;
        let perspective = 500;
        let start = null;
        let duration = 1500;
        let stepDistance = 250;
        let currentStep = 0;
        let ticking = false;
        let direction = -1; // {up: -1, down: 1}
        let toStart = false;

        stage.style.height = document.documentElement.clientHeight + 'px';

        if(!isMobile)
        {
            for(let i = 0; i < headers.length; i++)
            {
                let maxWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0) * .25;
                let width = headers[i].offsetWidth;
                let height = headers[i].offsetHeight;
                let z = stepDistance - (stepDistance * i);
                let scale = (perspective - z) / perspective;

                /**
                 * Set header translateZ and translateY
                 */
                headers[i].style.transform = 'translateX(-100%) translateX(-7vw) translateY(-50%)';

                if(i > 0) {
                    headers[i].style.transform = 'translateZ(-250px) translateX(-100%) translateX(-7vw) translateY(-50%)';
                }

                /**
                 * Store width/height of largest header
                 */
                if(width * height > headerDim.w * headerDim.h)
                {
                    headerDim.w = width;
                    headerDim.h = height;
                }
            }

            if(maxHeaderWidth / headerDim.w < 1)
            {
                let diff = maxHeaderWidth / headerDim.w;

                for(let i = 0; i < headers.length; i++)
                {
                    let svg = SVG.adopt(headers[i].querySelector('svg'));
                    let width = svg.bbox().w;
                    let height = svg.bbox().h;

                    svg.size(width * diff, height * diff);
                }
            }
        }

        // for(let i = 0; i < dots.length; i++)
        // {
        //     let dot = dots[i];
        //
        //     dot.addEventListener('click', function(e)
        //     {
        //         let index = getElementIndex(dot);
        //         init(index);
        //     });
        // }

        Object.assign(mainH1.style,
        {
            // 'position': 'absolute',
            // 'left': '0',
            // 'top': '50%',
            // 'transform': 'translate(calc(-100% - 7vw), -50%)',
            // '-ms-transform': 'translateX(-100%) translateX(-7vw) translateY(-50%) translateY(-50%)' /* IE 11 */
            //width: headerDim.w + 'px',
            height: headerDim.h + 'px'
        });

        let shapes = [
            {
                'ele': document.querySelector('.shape.s-1'),
                'header': headers[0],
                'startZ': 0
            },
            {
                'ele': document.querySelector('.shape.s-2'),
                'header': headers[1],
                'startZ': 0
            },
            {
                'ele': document.querySelector('.shape.s-3'),
                'header': headers[2],
                'startZ': 0
            },
            {
                'ele': document.querySelector('.shape.s-4'),
                'header': headers[3],
                'startZ': 0
            },
        ];

        for(let i = 0; i < shapes.length; i++)
        {
            let z = stepDistance - (stepDistance * i);
            let bounding = shapes[i].ele.getBoundingClientRect();
            let scale = (perspective - z) / perspective;

            shapes[i].ele.style.transform = 'translateZ('+ z +'px) scale('+ scale +')';
            shapes[i].startZ = z;
            shapes[i].pos = [bounding.left, bounding.top];
            shapes[i].scale = scale;
        }

        stage.style.opacity = 1;

        addWheelListener(window, function(e)
        {
            fireInit(e);
        });

        if(isMobile)
        {
            let hammertime = new Hammer(document.getElementsByTagName("BODY")[0]);
            hammertime.get('swipe').set({ direction: Hammer.DIRECTION_ALL });

            hammertime.on('swipe', function(e)
            {
                fireInit(e);
            });
        }

        /**
         * Fire init on scroll / swipe
         */
        function fireInit(e)
        {
            if (!ticking)
            {
                // if(typeof e === 'object')
                // {
                //     direction = (e.deltaY > 0) ? -1 : 1;
                // } else {
                //     direction = e;
                // }
                direction = (e.deltaY) ? ((e.deltaY > 0) ? -1 : 1) : ((e.offsetDirection === 8) ? 1 : -1);

                if(currentStep == 0 && direction > 0) return;
                if(currentStep == shapes.length - 1 && direction < 0) toStart = true;

                ticking = true;

                init();
            }
        }

        /**
         * Begin render() loop inside requestAnimationFrame
         * @param step
         */
        function init(step = null)
        {
            updateDots(step);

            window.requestAnimationFrame(function(timestamp, step)
            {
                render(timestamp, step);
            });
        }

        /**
         * Update dot with active index
         * @param step
         */
        function updateDots(step)
        {
            if(!step)
            {
                // scroll event
                step = (toStart) ? 0 : (currentStep + -direction);
            } else
            {
                // dot click event
                direction = (step > currentStep) ? -1 : 1;
            }

            for(let i = 0; i < dots.length; i++)
            {
                dots[i].classList.remove('active');
                dots[step].classList.add('active');
            }
        }

        /**
         * Run updateScale function for duration
         * @param timestamp
         * @param step
         */
        function render(timestamp, step)
        {
            if (!start) start = timestamp;
            let elapsedTime = timestamp - start;
            let progress = elapsedTime / duration;

            if(typeof step !== 'undefined') currentStep = step;

            if (elapsedTime < duration)
            {
                updateScale(progress, step);
            }
            else
            {
                if(!step)
                {
                    // If scroll up on last step, go to 0 else check direction and move up/down 1
                    (currentStep == shapes.length - 1 && direction < 0) ? currentStep = 0 : ((direction < 1) ? currentStep++ : currentStep--);
                }

                start = null;
                ticking = false;
                toStart = false;
            }
        }

        /**
         * Updates the translateZ property of svg shapes, headers and dots
         * @param progress
         * @param step
         */
        function updateScale(progress, step)
        {
            for(let i = 0; i < shapes.length; i++)
            {
                // -3 -> 3
                let stepDiff = (step) ? (step - currentStep) : 0;
                let startZ = shapes[i].startZ;
                let stepOffset = startZ + (currentStep * stepDistance);
                let scale = shapes[i].scale;
                // linear easing
                // let z = stepDistance * progress;
                // 0 -> 750
                let zToStart = ease('easeOutQuint', 0, (progress * duration), 0, ((shapes.length - 1) * stepDistance), duration);
                // 0 -> 250, 0 -> 750 with step
                let z = ease('easeOutQuint', 0, (progress * duration), 0, (stepDistance + (stepDistance * stepDiff)), duration);
                // toStart: n -> n*stepDistance || !toStart: 0 -> 250
                let zFactored = (toStart) ? zToStart : z;
                let newZ = toStart ? stepOffset + (zFactored * direction) : stepOffset + (-zFactored * direction);
                let headerZ = ease('easeOutQuint', 0, (progress * duration), 0, 500, duration);
                // up: 0 -> 500 || down: 500 -> 0
                let newHeaderScale = (direction < 0 && !toStart) ? headerZ : 500 - headerZ;

                if(direction < 0) {
                    // down scroll - next
                    if(toStart) {
                        shapes[0].header.style.transform = 'translateZ('+ newHeaderScale +'px) translateX(-100%) translateX(-7vw) translateY(-50%)';

                        headers[currentStep].style.opacity = 1 - (stepDistance / z);
                        headers[currentStep].style.transform = 'translateZ('+ -z +'px) translateX(-100%) translateX(-7vw) translateY(-50%)';

                        copy[currentStep].style.opacity = 0;
                        copy[currentStep].style.display = 'none';
                        copy[0].style.display = 'block';
                        copy[0].style.opacity = 1;
                    } else {
                        shapes[currentStep].header.style.transform = 'translateZ('+ newHeaderScale +'px) translateX(-100%) translateX(-7vw) translateY(-50%)';

                        headers[currentStep + 1].style.opacity = stepDistance / zFactored;
                        // animate from -250px - 0
                        headers[currentStep + 1].style.transform = 'translateZ('+ (-stepDistance + zFactored) +'px) translateX(-100%) translateX(-7vw) translateY(-50%)';

                        copy[currentStep].style.opacity = 0;
                        copy[currentStep].style.display = 'none';
                        copy[currentStep + 1].style.display = 'block';
                        copy[currentStep + 1].style.opacity = 1;
                    }
                } else {
                    // up scroll - prev
                    shapes[currentStep - 1].header.style.transform = 'translateZ('+ newHeaderScale +'px) translateX(-100%) translateX(-7vw) translateY(-50%)';

                    headers[currentStep].style.opacity = 1 - (stepDistance / zFactored);
                    headers[currentStep].style.transform = 'translateZ('+ -zFactored +'px) translateX(-100%) translateX(-7vw) translateY(-50%)';

                    copy[currentStep].style.opacity = 0;
                    copy[currentStep].style.display = 'none';
                    copy[currentStep - 1].style.display = 'block';
                    copy[currentStep - 1].style.opacity = 1;
                }

                shapes[i].ele.style.transform = 'translateZ('+ newZ +'px) scale('+ scale +')';
            }

            window.requestAnimationFrame(render);
        }
    }
});