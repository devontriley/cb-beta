const mainHeader = document.querySelector('.main-header');

if(mainHeader) {
    let previous = window.scrollY;

    document.getElementsByTagName('body')[0].onscroll = (e) => {
        let scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        let direction = window.scrollY > previous ? 'down' : 'up';
        previous = window.scrollY;

        if(direction == 'down') {
            mainHeader.classList.remove('main-header--scroll-up');

            if(scrollPosition > 0) {
                mainHeader.classList.add('main-header--hide');
            } else {
                mainHeader.classList.remove('main-header--hide');
            }
        }

        if(direction == 'up') {
            mainHeader.classList.remove('main-header--hide');

            if(scrollPosition > 0) {
                mainHeader.classList.add('main-header--scroll-up');
            } else {
                mainHeader.classList.remove('main-header--scroll-up');
            }
        }
    };
}