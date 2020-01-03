var $ = jQuery;

function scrollMe() {
$('a.anchor_link').click(function() {
    $('html, body').animate({
    scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
    }, 1000);
    return false;
});
}

$(document).ready(function(){
    scrollMe();
});