$(function(){
	$.ajax({
		url:"/php/server/facility.php",
		type: "get",
		dataType: "json",
		data:{
			process: dataprocess,
			ident: ident,
			userid: userid
		},
	})
	.done(function (responses){
		console.log('成功');
		console.log(JSON.stringify(responses));
		if(dataprocess === "detail"){	//詳細情報
			dispDetailFacility(responses[0]);
			// if(responses[0].orderdate !== null){
			dispCalendar(responses[0]);
			// }
			// else{
			// 	dispCalendar(null);
			// }
		}
		else if(dataprocess === "order"){
			dispOrder(responses[0], calendar_val,userid);
		}
		else if(dataprocess === "mypage"){	//mypege上に自分が投稿した施設情報を表示	
			for(count = 0; count < responses.length; count++){
				dispMyFacility(responses[count], count);
			}
			$("#tabFacility").append($("<span class='badge'></span>")
						  .text(responses.length));
		}
		else if(dataprocess === "checkOrder"){	//予約状況の確認
			dispOrderCheck(responses[0]);
		}
	})
	.fail(function(){
		console.log('失敗');
	});

});