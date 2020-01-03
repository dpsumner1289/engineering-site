// Counter row figure animation

var $ = jQuery;

function countUp(el) {
	$(el).each(function() {
		$(this).prop('Counter', 0).animate({
			Counter: $(this).text()
		}, {
			duration: 2000,
			easing: 'swing',
			step: function(now) {
				$(this).text(Math.ceil(now).toLocaleString());
			}
		});
	});
}

function checkVisible(elm, eval) {
	eval = eval || "object visible";
	var viewportHeight = $(window).height(), // Viewport Height
		scrolltop = $(window).scrollTop(), // Scroll Top
		y = $(elm).offset().top,
		elementHeight = $(elm).height();

	if (eval == "object visible") return ((y < (viewportHeight + scrolltop)) && (y > (scrolltop - elementHeight)));
	if (eval == "above") return ((y < (viewportHeight + scrolltop)));
}

if ($('.counter_row').length) {
	$(window).on('scroll', function() {

		if (checkVisible($('.counter_row'))) {
			countUp('.count');
			$(window).off('scroll');
		} else {
			// do nothing
		}
	});
} else {
	console.log('No numbers here...');
}