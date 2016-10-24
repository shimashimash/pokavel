$(function() {
	$('div.myCard', this).on('click', function() {
		$(this).toggleClass('hold');
		if ($(this).hasClass('hold')) {
			$('.mask', this).show();
		} else {
			$('.mask', this).hide();
		}
	});
});