var $ = jQuery;

// dynamically detect header height and offset hero image

function adjustHeight() {
	var header = $('.site-header');
	var headerHeight = header.height();
	$('.fs-full-screen').css('min-height', 'calc(100vh - ' + headerHeight + 'px)');
}

$(document).ready(function(){
	if($('.fs-full-screen').length) {
		adjustHeight();		
	}
});

// Add checks to checklists

jQuery(document).ready(function($) {
	$('#content ul li').prepend('<i class="fas fa-caret-right"></i>');
});