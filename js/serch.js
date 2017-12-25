$(function(){//位置情報を使わない検索

	console.log(serchparam);
	console.log(area);
	console.log(infras);
	$("#paramValue").val(serchparam);
	$("#area").val(area);

	// console.log($(".infra").eq(0).val());
	if(infras !== null){
		for(i = 0; i < infras.length; i++){
			//遷移前のチェックボックスの状態にする
			for(j = 0; j < 10; j++){
				if($(".infra").eq(j).val() === infras[i]){
					$(".infra").eq(j).prop("checked", true);
					break;
				}
			}
		}
	}

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
});