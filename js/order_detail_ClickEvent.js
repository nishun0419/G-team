$('.go_mypage').on('click', function(){
	location.href = '/php/php/mypage.php';
});
$('.order_cancel_button').on('click', function(){
	$('#order_cancel').modal();
})