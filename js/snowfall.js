$(function(){
	$('#animation_back').snowfall({
		flakeCount :150, // 数
   		flakeIndex : 99999, // スタイルシートのz-indexの値
   		maxSpeed : 6, // 最大速度
   		minSpeed : 1, // 最小速度
   		maxSize  : 30, // 最大サイズ
   		minSize  : 5, // 最小サイズ
   		image : '/php/image/snow_crystal_blue.png'
	});
   // $("#animation_back").snowfall();
});

function bodysnow(){
	$('body').snowfall({
	flakeCount :20, // 数
   flakeIndex: 9999, 
   	maxSpeed : 6, // 最大速度
   	minSpeed : 1, // 最小速度
   	maxSize  : 20, // 最大サイズ
   	minSize  : 5, // 最小サイズ
   	// image: '/php/image/snowflakes.png'
      image: '/php/image/snow_crystal_blue.png'
	});
}