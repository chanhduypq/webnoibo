$(function() {
    $(window).scroll(function() {
    });
    $('#bttop').click(function() {
        $('body,html').animate({scrollTop: 0}, 800);
    });
});