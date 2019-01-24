import tingle from './../../node_modules/tingle.js/dist/tingle.js';

const body = document.getElementsByTagName('body')[0];
const mainNavBtn = document.querySelector('.main-header__hamburger');
const mobileNav = document.querySelector('.mobile-nav');
const mobileNavClose = document.querySelector('.mobile-nav__close');

if(mainNavBtn && mobileNav) {
    // const modal = new tingle.modal({
    //     footer: false,
    //     stickyFooter: false,
    //     closeMethods: ['overlay', 'escape'],
    //     cssClass: ['tingle-modal--cover'],
    //     onOpen: function() {
    //     },
    //     onClose: function() {
    //         console.log('modal close');
    //     },
    //     beforeClose: function() {
    //         return true; // close
    //         return false; // nothing happens
    //     }
    // });
    //
    // modal.modalBoxContent.classList.add('tingle-modal-box__content--noPadding');

    // Set content to html on page and remove disabled style
    //modal.setContent(mainNav);
    //mainNav.classList.remove('modal-content--disabled');

    // Add click event listener
    mainNavBtn.addEventListener('click', function(e){
        e.preventDefault();
        //modal.open();

        body.classList.add('mobile-nav-active');
    });

    mobileNavClose.addEventListener('click', (e) => {
        e.preventDefault();

        body.classList.remove('mobile-nav-active');
    })
}