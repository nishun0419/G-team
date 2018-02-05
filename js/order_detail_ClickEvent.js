$('.go_mypage').on('click', function(){
	location.href = '/teamG/php/mypage.php';
});
$('.order_cancel_button').on('click', function(){
	$('#order_cancel').modal();
})