jQuery(window).on('load', function() {
	setTimeout(function () {
		jQuery('.ms-msg').fadeOut(300);
	}, 2000);
});
// description toggle
jQuery('span.cwfw_tooltip_icon').click(function (event) {
	event.preventDefault();
	jQuery(this).next('p.description').toggle();
});