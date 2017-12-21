function defaultSerch(){//位置情報を使わない検索
	var infras=[];
	$("[name='infra[]']:checked").each(function(){
		infras.push(this.value);
	});
	console.log(infras.length);
	console.log(infras);
	console.log($("#paramValue").val())
	console.log($("#area").val())

	$.ajax({
		url:"/php/server/facility.php",
		type: "get",
		dataType: "json",
		data:{
			process: "serch",
			keyword: $("#paramValue").val(),
			infras: infras,
			area:$("#area").val(),
		},
	})
	.done(function(responses){
		console.log("成功");
		console.log(JSON.stringify(responses));
		if(Object.keys(responses).length === 0 ){
			$("#serchResult").text("検索結果がありません");
			console.log("無し");
		}
		else{
			$("#serchResult").empty();
			for(count = 0; count < responses.length; count++){
				dispFacility(responses[count],count);
			}
		}
	})
	.fail(function(){
		console.log('失敗');
	});
}