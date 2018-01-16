$(function(){
 $("#form1").submit(function(){
if($('#Password').val() === $('#PasswordConfirm').val()){
	  return true;
	}
	else {
		alert("パスワードが一致しません。");
	  return false;
	}
    });
});
