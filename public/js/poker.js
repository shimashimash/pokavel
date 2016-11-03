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

	//judgeボタンを押した時の処理
	$('.judgeBtn').on('click', function() {
		//holdされたカードのsrcを送る
		if ($('.myField').children('.myCard').hasClass('hold')) {
			var holdSrcInput = '';
			$('.hold').each(function(index, element) {
				var holdImgSrc = $(element).children('img').attr('src');
				holdSrcInput += '<input type="hidden" name="myHand[]" value="'+ holdImgSrc + '">';
			});
			$('.myCard').children('input[name="myHand[]"]').remove();
			//holdされたカードのkeyを送るinputの属性値を変更
			$('.hold').children('input[name="discardKey[]"]').attr('name', 'holdCardKey[]');
			$('.myField').append(holdSrcInput);
			$('#holdSrcForm').submit();
		}
	});
});