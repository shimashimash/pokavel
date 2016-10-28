$(function() {
	//HoldのON,OFF
	$('div.myCard', this).on('click', function() {
		$(this).toggleClass('hold');
		if ($(this).hasClass('hold')) {
			$('.mask', this).show();
		} else {
			$('.mask', this).hide();
		}
	});

	//holdしたカードのsrcを送る
	$('.judgeBtn').on('click', function() {
		var holdSrcInput = '';
		holdSrcInput += '<form action="/poker/judge" method="post" id="holdSrcForm">';
		$('.hold').each(function(index, element) {
			var holdImgSrc = $(element).children('img').attr('src');
			holdSrcInput += '<input type="hidden" name="holdSrc[]" value=" ' + holdImgSrc + ' ">';
		});
		holdSrcInput += '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">'
		holdSrcInput += '</form>';
		$('.myField').after(holdSrcInput);
		$('#holdSrcForm').submit();
	});
});