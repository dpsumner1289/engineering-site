// Click button to expand feature list

var $ = jQuery;

$(document).ready(function($) {
	$('button.show').toggle(function() {
		var setHeight = $(this).closest('div').find('.feature-list').height();
		if (setHeight > 200) {
			$(this).closest('div').find('.list-container').animate({
				height: setHeight
			}, 400);
			$(this).closest('div').find('.list-container').addClass('noblur');

			$(this).text('Show Less');
		}
	}, function() {
		$(this).closest('div').find('.list-container').animate({
			height: '200px'
		}, 400);

		$(this).closest('div').find('.list-container').removeClass('noblur');
		$(this).text('Show More');
	});
});