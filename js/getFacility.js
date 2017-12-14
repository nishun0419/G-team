$(function(){
	$.ajax({
		url:"/php/server/facility.php",
		type: "get",
		dataType: "json",
		data:{
			keyword: serchparam,
			process: dataprocess,
			ident: ident,
			userid: userid
		},
	})
	.done(function (responses){
		console.log('成功');
		console.log(JSON.stringify(responses));
		if(dataprocess === "top"){
			for(count = 0; count < responses.length; count++){
				dispFacility(responses[count],count);	
			}
		}
		else if(dataprocess === "detail"){
			dispDetailFacility(responses[0]);
			if(responses[0].orderdate !== null){
				dispCalendar(responses[0].orderdate);
			}
			else{
				dispCalendar(null);
			}
		}
		else if(dataprocess === "order"){
			dispOrder(responses[0], calendar_val,userid);
		}
		else if(dataprocess === "mypage"){
			for(count = 0; count < responses.length; count++){
				dispMyFacility(responses[count], count);
			}
			getOrder();
		}
	})
	.fail(function(){
		console.log('失敗');
	});

});