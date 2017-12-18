function getPdf(date){
	$.ajax({
		url:"/php/server/orderserver.php",
		type: "get",
		dataType: "json",
		data:{
			orderdate: date,
			process: "order_check",
			facilityid: ident
		},
	})
	.done(function(responses){
		console.log('成功');
		console.log(JSON.stringify(responses));
		dispPdf(responses[0]);
	})
	.fail(function(){
		console.log('失敗');
	});
}