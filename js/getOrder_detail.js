$(function(){
	$.ajax({
		url: "/php/server/orderserver.php",
		type: "get",
		dataType: "json",
		data:{
			ResID : ResID,
			process: "order_detail"
		},
	})
	.done(function(responses){
		$("#fac_name").text(responses[0].fac_name);
		$("#fac_address").text("〒" + responses[0].PostNum + " " + responses[0].Pref + responses[0].Address);
		$("#fac_price").text("￥" + responses[0].fac_price);
		$("#fac_order").text(responses[0].fac_order);
	})

	.fail(function(){
		console.log('失敗');
	});

});