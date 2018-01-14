<?php

header("Content-type: text/html; charset=UTF-8");
mb_language("Japanese");
mb_internal_encoding("UTF-8");

?>


<!DOCTYPE html>
<html>
<head>
    <title>緯度経度取得テスト</title>
</head>
<body>

<br>

<?php

if( !preg_match('/^[0-9\.]+$/', $_POST['add']) ){
	echo 'エラーメッセージ出す';
}else{
	echo 'OKにする';
}

?>

<br>
</body>
</html>