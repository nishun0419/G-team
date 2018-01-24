$(function(){
$(document).on('click','.cancel_button', function(){
	var index = $('.upcancel_toggle').index(this);
	// console.log($('.cancelID').eq(index).val());
	$('#upID').val($('.cancelID').eq(index).val());
	$('.modal-title').text('登録取り下げ');
	$('.modal-body').text('登録を取り下げます。よろしいですか？');
	$('.upCancelbutton').text('取り下げ');
	$('#post_cancel').modal();
});
$(document).on('click','.up_button', function(){
	var index = $('.upcancel_toggle').index(this);
	// console.log($('.cancelID').eq(index).val());
	$('#upID').val($('.cancelID').eq(index).val());
	$('.modal-title').text('再登録');
	$('.modal-body').text('再登録します。よろしいですか？');
	$('.upCancelbutton').text('再登録');
	$('#post_cancel').modal();
})

});