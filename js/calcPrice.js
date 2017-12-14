$(function(){
	var price = 5000;

	$({count: price}).delay(1000).animate({count: price-2000},{
		duration: 2000,
		easing: 'swing',
		progress: function(){
			$('#price_box span').text(Math.ceil(this.count));

		},
		complete: function(){
			$(".check").css("visibility", "visible");
		}
		
	});
});

$('.check').on('click', function(){
	$("#white_back").hide();
});