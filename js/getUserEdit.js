$(function(){
	console.log(userid);
	$.ajax({
		url:"/php/server/getUserserver.php",
		type:"get",
		dataType: "json",
		data:{
			userid: userid,
		},
	})
	.done(function(responses){
		console.log("ss");
		console.log(JSON.stringify(responses));
		$("#FamilyName").val(responses[0].FamilyName);
		$("#GivenName").val(responses[0].GivenName);
		$("#FamilyNameKana").val(responses[0].FamilyNameKana);
		$("#GivenNameKana").val(responses[0].GivenNameKana);
		$("#Usertel").val(responses[0].UserTel);
		$("#UserMailAdress").val(responses[0].UserMailAddress);
		$("#UserPostNum").val(responses[0].UserPostNum);
		$("#UserAdress").val(responses[0].UserPref);
		$("#UserAdress2").val(responses[0].UserCity);

	})
	.fail(function(){
		console.log("失敗");
	})
})