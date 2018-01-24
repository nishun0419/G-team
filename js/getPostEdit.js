$(function(){
	$.ajax({
		url:"/php/server/facility.php",
		type:"get",
		dataType: "json",
		data:{
			UpID: UpID,
			process: "edit_post"
		},
	})
	.done(function(responses){
		console.log("ss");
		console.log(JSON.stringify(responses));
		$("#fac_name").val(responses[0].FacName);
		$("#zip1").val(responses[0].zip1);
		$("#zip2").val(responses[0].zip2);
		// AjaxZip3.zip2addr('zip1','zip2','address1','address2');
		$("#address1").val(responses[0].Pref);
		// var work = $("#address2").val();
		$("#address2").val(responses[0].Address);
		$("#fac_email").val(responses[0].MailAddress);
		$("#fac_tel").val(responses[0].Tel);
		$("#datepickerFrom").val(responses[0].StartDate);
		$("#datepickerTo").val(responses[0].StopDate);
		$("#exposition").val(responses[0].Exposition);
		$("#people").val(responses[0].PeopleNum);
		$("#fac_area").val(responses[0].Area);
		$("#price").val(responses[0].Price);

		//チェックボックスの処理
		//アメニティ
		var infras = responses[0].Infras;

			for(i = 0; i < 10; i++){
				if(infras[i] === "1"){
					$(".infras").eq(i).prop("checked",true);
				}
			}

		//カテゴリー
		var categorys = responses[0].Categorys;
			for(i = 0; i < categorys.length; i++){
				$(".categorys").eq(categorys[i] - 1).prop("checked",true);
			}

		//支払い方法
		var payarray = responses[0].Pays;
			for(i = 0; i < 3; i++){
				if(payarray[i] === "1"){
					$(".pays").eq(i).prop("checked",true);
				}
			}

	})
	.fail(function(){
		console.log("失敗");
	})
})