import "@babel/polyfill";
import objectFitImages from 'object-fit-images';

// New CustomEvent Polyfill for IE9+
(function ()
    {
        if ( typeof window.CustomEvent === "function" ) return false;

        function CustomEvent ( event, params ) {
            params = params || { bubbles: false, cancelable: false, detail: null };
            var evt = document.createEvent( 'CustomEvent' );
            evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
            return evt;
        }

        CustomEvent.prototype = window.Event.prototype;

        window.CustomEvent = CustomEvent;
    }
)();

const css = require('../css/root.css');

// This enables application of JS modules changes in HTML view.
// Don't remove it!
if (module.hot) {
    module.hot.accept();
}

//import Barba from './../../node_modules/barba.js/dist/barba.js';

require('./../../node_modules/pepjs/dist/pep.js');
require('./../../node_modules/hammerjs/hammer.min.js');

import './home-animation.js';
import './styled-select.js';
import './global.js';
import './main-header.js';
import './mobile-nav.js';
import './form.js';
import './work-filter.js';
import './team-slider.js';
import './image-four-callouts.js';
import './text-grid.js';
import './quote-slider.js';
import './tab-system.js';
import './video-loader.js';
import './image-carousel.js';
import './mobile-displays.js';
import './image-grid.js';
import './scroll-tracker.js';
import './locations.js';

require('./../../node_modules/calc-polyfill/calc.min');

$(document).ready(function(){
    objectFitImages();
});

// Barba.Pjax.start();
//
// // TODO: Remove this eventually
// // This is strictly in place to allow Barba.js to work with Browsersync
// // Browsersync will rewrite links pulled with barba to not use the proxy
// Barba.Dispatcher.on('newPageReady', function(currentStatus, prevStatus) {
//     var links = document.querySelectorAll('a[href*="localhost/cb"]');
//     for(var i = 0; i < links.length; i++) {
//         links[i].href = links[i].href.replace('localhost\/', 'localhost:3000\/');
//     }
// });