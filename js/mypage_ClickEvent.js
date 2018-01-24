$(function(){
$(document).on('click','.cancel_button', function(){
	var index = $('.cancel_button').index(this);
	// console.log($('.cancelID').eq(index).val());
	$('#upID').val($('.cancelID').eq(index).val());
	$('#post_cancel').modal();
})
});