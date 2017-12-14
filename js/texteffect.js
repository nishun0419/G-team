$(function (){
	$('.animationtext1').textillate({
		selector: 'texts',
		loop: false,
		minDisplayTime: 1000,
		initialDelay: 0,
		autoStart: true,
		outEffects:['hinge'],
		in:{
			effect: 'fadeInRight',
			delayScale: 1.5,
			delay: 50,
			sync: false,
			shuffle: false,
			reverse: false,
			callback:animationtext2
		},
		callback: function(){},
		type: 'char'

	});
});
function animationtext2(){
	$('.animationtext2').textillate({
		selector: 'texts',
		loop: false,
		minDisplayTime: 1000,
		initialDelay: 0,
		autoStart: true,
		outEffects:['hinge'],
		in:{
			effect: 'fadeInLeft',
			delayScale: 1.5,
			delay: 50,
			sync: false,
			shuffle: false,
			reverse: false,
			callback:animationtext3
		},
		callback: function(){},
		type: 'char'

	});

}

function animationtext3(){
	$('.xImage').fadeIn(400);
	$('.animationtext3').delay(1000).fadeIn(400,function(){
		$('#animation_back').delay(1000).fadeOut("slow",bodysnow);
		// bodysnow();
	});

}