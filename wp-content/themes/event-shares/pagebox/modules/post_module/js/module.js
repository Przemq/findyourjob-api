$(document).ready(function () {
    AOS.init();
    $('.copyLink').on('click',function (e) {
        e.preventDefault();
        $('.copyLinkText').slideToggle(400);
    })
});