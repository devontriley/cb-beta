import { ease } from './utils.js';
import './../../node_modules/svgjs/dist/svg.js';
import './../../node_modules/svg-filter/index.js';

const canvas = document.querySelector('.home-animation');

if(canvas)
{
    let canvasW = window.innerWidth,
        canvasH = window.innerHeight;
        // Set canvas size
        canvas.style.width = canvasW + 'px';
        canvas.style.height = canvasH + 'px';

    let progress = 0,
        stepProgress = 0,
        allowScroll = true,
        stepDuration = 1,
        currentStep = 0,
        easeType = 'easeInOutCubic',
        rewindSteps = false;

    let svg = document.querySelector('.home-animation__svg'),
        svgObj = SVG.adopt(svg);

    // SVG Groups
    let groupsArr = [],
        groups = svg.querySelectorAll('g');

    // Loop groups and create object with properties
    for(let i = 0; i < groups.length; i++)
    {
        let g = groups[i];

        groupsArr.push({
            ref: g,
            svgObj: svgObj.children()[i],
            startFrame: 0,
            opacity: 1,
            stepStartScale: 1,
            initScaleFactor: Math.pow(.5, i)
        })
    }

    let headers = document.querySelectorAll('.home-animation__header');

    window.addEventListener('mousewheel', function(e){
        e.preventDefault();

        if(allowScroll) renderAnim(e.deltaY);
    });

    function renderAnim(delta)
    {
        let direction = delta;

        // Track progress at 60 fps
        progress += 1 / 60;
        stepProgress += 1 / 60;

        // Restrict scroll from firing render()
        allowScroll = false;

        // Do nothing when scrolling down on first step or scrolling up on last step
        if(direction > 0 && currentStep == 0)
        {
            allowScroll = true;
            return;
        }

        if(direction < 0 && currentStep == groupsArr.length -1)
        {
            //stepDuration = 2;
            rewindSteps = true;
        }

        // Loop animation for stepDuration length, increment/decrement currentStep, set group scales, allow scrolling
        if(stepProgress >= stepDuration)
        {
            stepProgress = 0;

            (direction > 0) ? currentStep-- : currentStep++;

            if(rewindSteps)
            {
                rewindSteps = false;
                //stepDuration = 1;
                currentStep = 0;
            }

            for(let i = 0; i < groupsArr.length; i++)
            {
                let group = groupsArr[i];
                group.stepStartScale = group.ref.getBoundingClientRect().width / group.ref.getBBox().width; // set group scale at the end of each step
            }
            allowScroll = true;
            return;
        }

        // Set which group index to start looping through
        let loopStartIndex = 0;
        if(rewindSteps)
        {
            loopStartIndex = 0;
        }
        else if(direction > 0)
        {
            loopStartIndex = currentStep -1;
        }
        else if(direction < 0)
        {
            loopStartIndex = currentStep;
        }

        // Loop through groups and update scale
        for(let i = loopStartIndex; i < groupsArr.length; i++)
        {
            let scaleMax = 0;

            if(rewindSteps)
            {
                switch(i)
                {
                    case 0:
                        scaleMax = 4;
                        break;
                    case 1:
                        scaleMax = 4.5;
                        break;
                    case 2:
                        scaleMax = 4.625;
                        break;
                    case 3:
                        scaleMax = .6875;
                        break;
                }
            }
            else
            {
                switch(currentStep) {
                    case 0:
                        switch(i) {
                            case 0:
                                scaleMax = (direction < 0) ? 4 : 4;
                                break;
                            case 1:
                                scaleMax = (direction < 0) ? .5 : .5;
                                break;
                            case 2:
                                scaleMax = (direction < 0) ? .125 : 0.125;
                                break;
                            case 3:
                                scaleMax = (direction < 0) ? .0625 : .0625;
                                break;
                        }
                        break;

                    case 1:
                        switch(i) {
                            case 0:
                                scaleMax = (direction < 0) ? 4 : 4;
                                break;
                            case 1:
                                scaleMax = (direction < 0) ? 4 : .5;
                                break;
                            case 2:
                                scaleMax = (direction < 0) ? .5 : .125;
                                break;
                            case 3:
                                scaleMax = (direction < 0) ? .125 : .0625;
                                break;

                        }
                        break;

                    case 2:
                        switch(i) {
                            case 0:
                                scaleMax = (direction < 0) ? 4 : 4;
                                break;
                            case 1:
                                scaleMax = (direction < 0) ? 4 : 4;
                                break;
                            case 2:
                                scaleMax = (direction < 0) ? 4 : .5;
                                break;
                            case 3:
                                scaleMax = (direction < 0) ? .5 : .125;
                                break;
                        }
                        break;

                    case 3:
                        switch(i) {
                            case 0:
                                scaleMax = (direction < 0) ? 4: 4;
                                break;
                            case 1:
                                scaleMax = (direction < 0) ? 4 : 4;
                                break;
                            case 2:
                                scaleMax = (direction < 0) ? 4 : 4;
                                break;
                            case 3:
                                scaleMax = (direction < 0) ? 4 : .5;
                                break;
                        }
                        break;
                }
            }

            let offset = 0;
            if(rewindSteps)
            {
                offset = (((groupsArr.length - 1) - i) * .25) * stepDuration;

                if(stepProgress < offset) continue;
            }

            let group = groupsArr[i],
                //scaleEased = scaleMax * (stepProgress / stepDuration),
                scaleEased = ease(easeType, 0, (stepProgress - offset), 0, scaleMax, (stepDuration - offset)),
                newScale = (direction < 0) ? group.stepStartScale + scaleEased : group.stepStartScale - scaleEased,
                newOpacity = 1;

            if(direction < 0)
            {
                if(i == currentStep)
                {
                    newOpacity = 1 - ease(easeType, 0, stepProgress, 0, 1, stepDuration);
                }
            }
            else
            {
                if(i == currentStep - 1)
                {
                    newOpacity = ease(easeType, 0, stepProgress, 0, 1, stepDuration);
                }
            }

            if(rewindSteps)
            {
                newScale = group.stepStartScale - scaleEased;
                if(i < groupsArr.length - 1)
                {
                    newOpacity = ease(easeType, 0, (stepProgress - offset), 0, 1, (stepDuration - offset));
                }
                else
                {
                    newOpacity = 1;
                }

            }

            // Adjust scale
            group.ref.style.transform = 'scale(' + newScale + ')';

            // Adjust opacity when moving into background
            group.svgObj.attr('fill-opacity', newOpacity);

            if(i == 0)
            {
                let headerScaleEased = ease(easeType, 0, stepProgress, 0, 3, stepDuration),
                    newHeaderScale = headerScaleEased + 1;

                headers[0].style.transform = 'scale('+ newHeaderScale +') translateX(-'+ newHeaderScale +'px)';
                headers[0].style.opacity = newOpacity;
            }
        }

        window.requestAnimationFrame(function()
        {
            renderAnim(delta);
        });
    }
}