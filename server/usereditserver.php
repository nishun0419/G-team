<?php

	header("Content-Type:text/html;charset=UTF-8");
	session_start();
	$resMes = "success";
	$name = $_POST['username'];

	// バリデーションチェック
	// 名前の形式・長さチェック
	if(empty($_POST['family']) || empty($_POST['given']) || empty($_POST['family_kana']) || empty($_POST['given_kana']) ){
		$_SESSION['message_UEdit'] = "名前を入力してください";
	}
	elseif(preg_match('/[^ァ-ヶー]/u', $_POST['family_kana']) || preg_match('/[^ァ-ヶー]/u', $_POST['given_kana']) ){
		$_SESSION['message_UEdit'] = "ふりがなは全角カタカナで入力してください";
	}
	elseif(mb_strlen($_POST['family']) > 20 || mb_strlen($_POST['given']) > 20 || mb_strlen($_POST['family_kana']) > 20 || mb_strlen($_POST['given_kana']) > 20){
		$_SESSION['message_UEdit'] = "名前が長すぎます";
	}
	// 電話番号の形式・長さチェック
	elseif(empty($_POST['tel'])){
		$_SESSION['message_UEdit'] = "電話番号を入力してください";
	}
	elseif(!preg_match('/^[0-9-]+$/', $_POST['tel'])){
		$_SESSION['message_UEdit'] = "電話番号は半角数字と半角ハイフンで入力してください";
	}
	// メールアドレスの形式・長さチェック
	elseif(empty($_POST['email'])){
		$_SESSION['message_UEdit'] = "メールアドレスを入力してください";
	}
	elseif(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $_POST['email'])){
		$_SESSION['message_UEdit'] = "メールアドレスは正しく入力してください";
	}
	elseif(mb_strlen($_POST['email']) > 80){
		$_SESSION['message_UEdit'] = "メールアドレスが長すぎます";
	}
	// 郵便番号の形式(長さ)チェック
	elseif(empty($_POST['postnum'])){
		$_SESSION['message_UEdit'] = "郵便番号を入力してください";
	}
	elseif(!preg_match('/^\d{3}\-\d{4}$/', $_POST['postnum'])){
		$_SESSION['message_UEdit'] = "郵便番号は半角数字と半角ハイフンで入力してください。";
	}
	// 住所の長さチェック
	elseif(empty($_POST['pref']) || empty($_POST['city'])){
		$_SESSION['message_UEdit'] = "住所を入力してください";
	}
	elseif(mb_strlen($_POST['pref']) > 4 || mb_strlen($_POST['city']) > 40 || mb_strlen($_POST['address']) > 40){
		$_SESSION['message_UEdit'] = "住所が長すぎます";
	}
	// バリデーションチェックここまで
		
	if(isset($_SESSION['message_UEdit'])){
		$resMes = "false";
	}
	else{
		// DB接続
		$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
		$user = "kobe";
		$password = "denshi";

		try{

			// PDOで接続
			$dbh = new PDO($dsn, $user, $password);

			// update
			$sql = "update Users set FamilyName=?,GivenName=?,FamilyNameKana=?,GivenNameKana=?,UserPostNum=?,UserPref=?,UserCity=?,UserAddress=?,UserTel=?,UserMailAddress=? where UserID=?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, htmlspecialchars($_POST['family']), PDO::PARAM_STR);
			$stmt -> bindValue(2, htmlspecialchars($_POST['given']), PDO::PARAM_STR);
			$stmt -> bindValue(3, htmlspecialchars($_POST['family_kana']), PDO::PARAM_STR);
			$stmt -> bindValue(4, htmlspecialchars($_POST['given_kana']), PDO::PARAM_STR);
			$stmt -> bindValue(5, htmlspecialchars($_POST['postnum']), PDO::PARAM_STR);
			$stmt -> bindValue(6, htmlspecialchars($_POST['pref']), PDO::PARAM_STR);
			$stmt -> bindValue(7, htmlspecialchars($_POST['city']), PDO::PARAM_STR);
			$stmt -> bindValue(8, htmlspecialchars($_POST['address']), PDO::PARAM_STR);
			$stmt -> bindValue(9, htmlspecialchars($_POST['tel']), PDO::PARAM_STR);
			$stmt -> bindValue(10, htmlspecialchars($_POST['email']), PDO::PARAM_STR);
			$stmt -> bindValue(11, htmlspecialchars($_POST['id']), PDO::PARAM_STR);

			$stmt -> execute();

			// セッションのUserNameを更新
			$_SESSION['UserName'] = serialize(htmlspecialchars($_POST['family'].$_POST['given']));
			$dbh = null;

		}catch(PDOException $e){
			$_SESSION['message_UEdit'] = $e;
			$resMes = "error";
			echo $resMes;
		}
	}
	
	$_SESSION['UserID'] = serialize(htmlspecialchars($_POST['id']));

	if(!isset($_SESSION['message_UEdit'])){
		$resMes = session_name(). '='. session_id();
	}
	else{
		$_SESSION['UserName'] = serialize(htmlspecialchars($_POST['username']));
		$resMes = $resMes . "\n" .session_name(). '='. session_id();
	}
	echo $resMes;
