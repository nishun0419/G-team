<?php

header("Content-Type:text/html;charset=UTF-8");
session_start();
$resMes = "";
$url = ""; //header locationで遷移する先のurl保存用

// ログイン済か否か
if(!isset($_SESSION['UserID'])){
	$resMes = "ログインしてください。";
}
elseif(!isset($_POST['UpID'])){
	$resMes = "投稿IDが選択されていません。";
}
else{
	// DBに接続
	$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
	$user = "kobe";
	$password = "denshi";

	$UpID = htmlspecialchars($_POST['UpID']);

	try{
		// PDOで接続
		$dbh = new PDO($dsn, $user, $password);

		$sql = "select * from Posts where UpID=? and UserID=?";
		$stmt = $dbh -> prepare($sql);
		$stmt -> bindValue(1, $UpID, PDO::PARAM_STR);
		$stmt -> bindValue(2, unserialize($_SESSION['UserID']), PDO::PARAM_STR);
		$stmt -> execute();
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);

		// 上記SQL文で該当するものがあれば
		if($row){

			// 現在のUpCancelを取得 1(投稿中) or 0(取下中)
			// $result = $stmt -> fetch(PDO::FETCH_ASSOC);
			// $value = $result['UpCancel'];
			echo $row["UpCancel"];
			// exit;

			// 以下update処理
			$sql = "update Posts set UpCancel=? where UpID=?";
			$stmt = $dbh -> prepare($sql);
			if($row["UpCancel"] === '1' ){
				// 投稿取り下げ
				$stmt -> bindValue(1, '0' ,PDO::PARAM_STR);
				$url = "withdrawal.php";
			}else{
				// 再投稿
				$stmt -> bindValue(1, '1' ,PDO::PARAM_STR);
				$url = "reregistration.php";
			}
			$stmt -> bindValue(2, $UpID ,PDO::PARAM_STR);
			$stmt -> execute();
		}

		$dbh = null;
		// 遷移
		header("Location: /teamG/php/".$url);
		exit;

	}catch(PDOException $e){
		$resMes .= "PDOerror";
		echo $resMes;
	}
}