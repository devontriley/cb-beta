const checkMobileOnResize = (e) => {
    return Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
}
let body = document.getElementsByTagName('body')[0];

body.onresize = (e) => {
    if(checkMobileOnResize(e) >= 768) {
       body.classList.remove('is-mobile')
    }

    if(checkMobileOnResize(e) < 768 && window.mobilecheck()) {
        body.classList.add('is-mobile');
    }
}
