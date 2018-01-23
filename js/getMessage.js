$(function(){	
	$.ajax({
		url:"/php/server/messagebord.php",
		type: "get",
		dataType: "json",
		data:{
			keyword: serchparam
		},
	})
	.done(function (responses){
		// console.log('成功');
		// console.log(dataprocess);
		// console.log(JSON.stringify(responses))
		for(count = 0; count < responses.length; count++){
			if(dataprocess === "detail"){
				dispDetailMessage(responses[count]);
			}
			else{
				dispMessage(responses[count]);
			}	
		}
	})
	.fail(function(){
		console.log('失敗');
	});
});