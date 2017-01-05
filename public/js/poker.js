$(function() {
	//startボタンを押した時の処理
	$('#start').on('click', function() {
	    // var src = $('.trumpImg').attr('src');
	    // $.ajax({
	    //   url: '/poker/start', // 送信先
	    //   type: 'GET',
	    //   cache: false,
	    //   data: {'src':src},
	    //   dataType: 'json',//⇦こいつが原因
	    // })
	    // .done(function( data, textStatus, jqXHR ) { // 成功した時の処理
	    //   $('#start').after(data);
	    // 	  console.log(data);
	    // 	  console.log('success');
	    // })
	    // .fail(function( jqXHR, textStatus, errorThrown ) { // 失敗した時の処理
	    //   console.log('fail!');
	    // })
	    // .always(function( data, textStatus, errorThrown ) { // 通信に成功しても失敗しても表示される処理
	    //   console.log('always');
	    // });
	});

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
		//選択されたコインの値を取得する
		$('[name=bet] option:selected').text();
	});
});