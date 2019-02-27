function getElementIndex(node) {
    let index = 0;
    while ((node = node.previousElementSibling)) {
        index++;
    }
    return index;
}

function round(num, places)
{
    let multiplier = Math.pow(10, places);
    return Math.round(num * multiplier) / multiplier;
}

function ease(easeType,x,t,b,c,d)
{
    let value = '';

    switch(easeType) {
        case 'easeOutSine': // easeOutSine - faster out than in
            value = c * Math.sin(t/d * (Math.PI/2)) + b;
            break;

        case 'easeOutCubic': // easeOutCubic - fast out, slow in
            value = c*((t=t/d-1)*t*t + 1) + b;
            break;

        case 'easeOutQuint': // very fast out, very slow in
            value = c*((t=t/d-1)*t*t*t*t + 1) + b;
            break;

        case 'easeOutCirc':
            value = c * Math.sqrt(1 - (t=t/d-1)*t) + b;
            break;

        case 'easeOutExpo':
            value = (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
            break;

        case 'easeInExpo':
            value = (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
            break;

        case 'easeInQuart':
            value = c*(t/=d)*t*t*t + b;
            break;

        case 'easeInOutCubic':
            if ((t/=d/2) < 1) {
                value = c/2*t*t*t + b;
            } else {
                value = c/2*((t-=2)*t*t + 2) + b;
            }
            break;
    }

    return value;
}

function encodeHTML(s)
{
    return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}

module.exports = {
    ease,
    getElementIndex,
    round,
    encodeHTML
}