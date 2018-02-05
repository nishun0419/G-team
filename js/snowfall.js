$(function(){
	$('#animation_back').snowfall({
		flakeCount :30, // 数
   		flakeIndex : 99999, // スタイルシートのz-indexの値
   		maxSpeed : 6, // 最大速度
   		minSpeed : 1, // 最小速度
   		maxSize  : 30, // 最大サイズ
   		minSize  : 5, // 最小サイズ
   		image : '/teamG/image/snow_crystal_blue.png'
	});
   // $("#animation_back").snowfall();
});

function bodysnow(){
	$('body').snowfall({
	flakeCount :20, // 数
    flakeIndex: 5, 
   	maxSpeed : 6, // 最大速度
   	minSpeed : 1, // 最小速度
   	maxSize  : 20, // 最大サイズ
   	minSize  : 5, // 最小サイズ
   	// image: '/teamG/image/snowflakes.png'
      image: '/teamG/image/snow_crystal_blue.png'
	});
}