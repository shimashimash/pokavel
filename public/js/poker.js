$(function() {
	$('div.myCard', this).on('click', function() {
		$(this).toggleClass('hold');
		if ($(this).hasClass('hold')) {
			$('#holdShadow').show();
		} else {
			$('#holdShadow').hide();
		}
	});
});