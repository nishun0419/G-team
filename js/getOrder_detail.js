$(function(){
	$.ajax({
		url: "/teamG/server/orderserver.php",
		type: "get",
		dataType: "json",
		data:{
			ResID : ResID,
			process: "order_detail",
			UserID : UserID
		},
	})
	.done(function(responses){
		$("#fac_name").text(responses[0].fac_name);
		$("#fac_address").text("〒" + responses[0].PostNum + " " + responses[0].Pref + responses[0].Address);
		$("#fac_price").text("￥" + separate(responses[0].fac_price));
		$("#fac_order").text(responses[0].fac_order);
	})

	.fail(function(){
		console.log('失敗');
		location.href = '/teamG/php/error.php'; 
	});

});