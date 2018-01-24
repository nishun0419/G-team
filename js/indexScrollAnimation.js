$(function(){
	// $('.firstInfo').css({'visibility':'hidden', 'opacity':'0'});
	$('.secondInfo').css({'visibility':'hidden', 'opacity':'0'});


	$(window).scroll(function(){
		// if($(this).scrollTop() > 200){
		// 	for(var i = 0; i < 3; i++){
		// 		$('.firstInfo').eq(i).css({'visibility':'visible'}).delay(i * 500).animate({opacity: 1},500);
		// 	}
		// }

		if($(this).scrollTop() > 300){
			for(var i = 0; i < 3; i++){
				$('.secondInfo').eq(i).css({'visibility':'visible'}).delay(i * 500).animate({opacity: 1},500);
			}
		}
	})
})