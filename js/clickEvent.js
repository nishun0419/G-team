$(function(){

	var scrollpos;			//スクロールの値を保管する変数

	$('.post-new').on('click', function(){
		scrollpos = $(window).scrollTop();
		$('body').addClass('fixed').css({'top': -scrollpos});
		$('#white_back').css('display', 'block');
		$('#postBox').animate({height: '400px'},1000);
	});

	$('#close-PostBox').on('click', function(){
		$('body').removeClass('fixed').css({'top': 0});
		window.scrollTo(0, scrollpos);
		$('#postBox').animate({height: '50px'}, 1000);
		$('#white_back').css('display', 'none');
	});

	$('.close-task').on('click', function(){
		var taskId = $(this).prev().val();
		location.href="/SNS/delete?id=" + taskId;
	});

	$('#back-Top').on('click', function(){
		location.href="/SNS";
	});

	$('#detail-Delete').on('click', function(){
		var taskId= $('.task-Id').val();
		console.log(taskId);
		location.href="/SNS/delete?id=" + taskId; 
	});
});

