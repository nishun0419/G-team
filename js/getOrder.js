$(function(){
	$.ajax({
		url: "/php/server/orderserver.php",
		type: "get",
		dataType: "json",
		data:{
			userid : userid,
			process: "mypage"
		},
	})
	.done(function(responses){
		console.log(JSON.stringify(responses));
		for(count = 0; count < responses.length; count++){
			dispMyOrder(responses[count], count);
		}
	})
	.fail(function(){
		console.log('失敗');
	});

});