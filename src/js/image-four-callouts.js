import './../../node_modules/slick-carousel/slick/slick.js';

const imageFourCallouts = document.querySelector('.image-four-callouts');

if(mobileDetected)
{
    if(imageFourCallouts)
    {
        const imageFourCalloutsSlick = document.querySelector('.image-four-callouts__callouts');

        console.log(imageFourCalloutsSlick);

        $(imageFourCalloutsSlick).slick({
            'dots': true
        });
    }
}