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
		responses.sort(function(a,b){
			return (a.orderdate > b.orderdate ? 1:-1);
		})
		for(count = 0; count < responses.length; count++){
			dispMyOrder(responses[count], count);
		}
		$("#order_list_count").text(responses.length);
	})
	.fail(function(){
		console.log('失敗');
	});

});