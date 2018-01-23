$(function(){
	$.ajax({
		url:"/php/server/facility.php",
		type: "get",
		dataType: "json",
		data:{
			process: dataprocess,
			keyword: serchparam,
			area: area
		},
	})
	.done(function(responses){
		// console.log(JSON.stringify(responses));
		if(Object.keys(responses).length === 0 ){
			$("#serchResult").text("検索結果がありません");
			console.log("無し");
		}
		else{
			for(count = 0; count < responses.length; count++){
				dispFacility(responses[count], count);
			}
		}
	})
	.fail(function(){
		console.log('失敗');
	});
});