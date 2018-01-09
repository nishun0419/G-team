$("#dropout").submit(function(){
	if($("#inputID").val()==""){
		alert("入力してください");
		return false;
	}
	else  if( $("#inputID").val().match( /[^A-Za-z0-9\s.-]+/ ) ){
    alert("半角英文字で入力してください");
    return false;
   }
	// else if($("#inputID").val().indexOf(" ") == -1 || $("#inputID").val().indexOf("　") == -1){
	// 	alert("スペースがあります");
	// 	return false;
	// }
	else if($("#inputID").val().match(/^[ 　\r\n\t]*$/)){
  		alert("スペースなしでおねがいします");
  		return false;
  	}
	else if($("#inputID").val().length < 6){
		alert("6文字以上入力してください");
	}
	else if($("#inputPassword").val()==""){
		alert("入力してください");
		return false;
	}
	else{
		$("#dropout").submit();
	}
});

