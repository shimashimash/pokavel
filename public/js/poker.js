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

	$('.judgeBtn').on('click', function() {
		//holdされたカードのsrcを送る
		if ($('.myField').children('.myCard').hasClass('hold')) {
			var holdSrcInput = '';
			$('.hold').each(function(index, element) {
				var holdImgSrc = $(element).children('img').attr('src');
				holdSrcInput += '<input type="hidden" name="myHand[]" value="'+ holdImgSrc + '">';
			});
			$('.myCard').children('input[name="myHand[]"]').remove();
			//holdされたカードのkeyを送るinputを削除
			$('.hold').children('input[name="key[]"]').remove();
			$('.myField').append(holdSrcInput);
			$('#holdSrcForm').submit();
		}
	});
});