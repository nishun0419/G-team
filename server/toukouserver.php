<?php

header("Content-Type:text/html;charset=UTF-8");
session_start();
$resMes = "";

$res = array();				// 緯度経度保存用の配列

$upfile=explode("\t",htmlspecialchars($_POST["upfile"]));


// ログイン済か否か
if(!isset($_SESSION['UserID'])){
	$resMes = "UserIDがありません。";
}
else{

	// バリデーションチェック
	// 必須項目確認
	if(!isset($_POST['FacName']) || !isset($_POST['PostNum']) || !isset($_POST['Pref']) || !isset($_POST['Address']) || !isset($_POST['MailAddress']) || !isset($_POST['Tel']) || !isset($_POST['PeopleNum']) || !isset($_POST['StartDate']) || !isset($_POST['StopDate']) || !isset($_POST['Area']) || !isset($_POST['Price']) ){
		$resMes .= "必要項目が入力されていません。";
	}
	
	// 施設名の長さチェック
	elseif(mb_strlen($_POST['FacName']) > 64){
		$resMes .= "施設名が長すぎます。";
	}
	// 郵便番号の形式チェック
	elseif(!preg_match('/^\d{3}\-\d{4}$/', $_POST['PostNum'])){
		$resMes .= "郵便番号は半角数字と半角ハイフンで入力してください。";
	}
	// 住所の長さチェック
	elseif(mb_strlen($_POST['Pref']) > 4 || mb_strlen($_POST['Address']) > 80){
		$resMes .= "住所が長すぎます。";
	}
	// メールアドレスの形式・長さチェック
	elseif(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $_POST['MailAddress'])){
		$resMes .= "メールアドレスは正しく入力してください。";
	}
	elseif(mb_strlen($_POST['MailAddress']) > 80){
		$resMes .= "メールアドレスが長すぎます。";
	}
	// 電話番号の形式・長さチェック
	elseif(!preg_match('/^[0-9-]+$/', $_POST['Tel'])){
		$resMes .= "電話番号は半角数字と半角ハイフンで入力してください。";
	}
	elseif(mb_strlen($_POST['Tel']) > 20) {
		$resMes .= "電話番号が長すぎます。";
	}
	// 人数の形式・長さチェック
	elseif(!preg_match('/^[0-9]+$/', $_POST['PeopleNum'])){
		$resMes .= "人数は半角数字で入力してください。";
	}
	elseif(mb_strlen($_POST['PeopleNum']) > 5){
		$resMes .= "人数が多すぎます。";
	}
	// 日付の形式(長さ)チェック
	elseif(!preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}+$/', $_POST['StartDate']) || !preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}+$/', $_POST['StopDate'])){
		$resMes .= "日付は正しく入力してください。";
	}
	// 土地広さの形式・長さチェック
	elseif(!preg_match('/^[0-9.]+$/', $_POST['Area'])){
		$resMes .= "土地の広さは半角数字で入力してください。";
	}
	elseif(mb_strlen($_POST['Area']) > 10){
		$resMes .= "土地の広さが大きすぎます。";
	}
	// 説明文の長さチェック
	elseif(mb_strlen($_POST['Exposition']) > 1000){
		$resMes .= "説明文は1000文字以内で入力してください。";
	}
	// 料金の形式(長さ)チェック
	elseif(!preg_match('/^[0-9]{1,10}+$/', $_POST['Price'])){
		$resMes .= "料金は半角数字で入力してください。";
	}
	// 支払い方法の選択チェック
	elseif( !($_POST['pay_cash'] === '1' || $_POST['pay_card'] === '1' || $_POST['pay_cry'] === '1') ){
		$resMes .= "支払い方法は一つ以上選択してください。";
	}
	// バリデーションチェックここまで

	// バリデーションチェックでエラーがなければ
	// 住所から緯度経度を計算
	else{
		$address = $_POST['Pref'].$_POST['Address'];
		$req = 'http://maps.google.com/maps/api/geocode/xml?address='.urlencode($address).'&sensor=false';
		$xml = simplexml_load_file($req) or die('XML parsing error');
		if($xml->status == 'OK'){
			$location = $xml->result->geometry->location;
			$res['lat'] = (string)$location->lat[0];
			$res['lng'] = (string)$location->lng[0];
		}else{
			$resMes = "緯度経度取得エラー。";
		}
	}

	// アップロードでもエラーがなければ
	if(empty($resMes)){

		// 受け取ったカテゴリーIDを配列に挿入
		$category  = $_POST['cate'];

		// DBに接続
		$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
		$user = "kobe";
		$password = "denshi";

		try{

			// PDOで接続
			$dbh = new PDO($dsn, $user, $password);

			// Postテーブルにinsert
			$sql = "insert into Posts(UserID,FacName,Price,PostNum,Pref,Address,lat,lon,PeopleNum,Tel,MailAddress,Exposition,PostDate,StartDate,StopDate,UpCancel,Image1,Image2,Image3,Area,Electrical,Water,Gas,Toilet,BarrierFree,Network,Parking,AirCondition,FoodDrink,NoFire,CashPayFlag,CardPayFlag,CryptocurrencyPayFlag) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $dbh -> prepare($sql);
			/*UserID:ユーザID*/ $stmt -> bindValue(1, unserialize($_SESSION['UserID']), PDO::PARAM_STR);
			/*FacName:施設名*/ $stmt -> bindValue(2, htmlspecialchars($_POST['FacName']), PDO::PARAM_STR);
			/*Price:料金*/ $stmt -> bindValue(3, htmlspecialchars($_POST['Price']), PDO::PARAM_STR);
			/*PostNum:郵便番号*/ $stmt -> bindValue(4, htmlspecialchars($_POST['PostNum']), PDO::PARAM_STR);
			/*pref:都道府県*/ $stmt -> bindValue(5, htmlspecialchars($_POST['Pref']), PDO::PARAM_STR);
			/*Address:住所*/ $stmt -> bindValue(6, htmlspecialchars($_POST['Address']), PDO::PARAM_STR);
			/*lat:緯度*/ $stmt -> bindValue(7, $res['lat'], PDO::PARAM_STR);
			/*lon:経度*/ $stmt -> bindValue(8, $res['lng'], PDO::PARAM_STR);
			/*PeopleNumNum:収容人数*/ $stmt -> bindValue(9, htmlspecialchars($_POST['PeopleNum']), PDO::PARAM_STR);
			/*Tel:電話番号*/ $stmt -> bindValue(10, htmlspecialchars($_POST['Tel']), PDO::PARAM_STR);
			/*MailAddress:メール*/ $stmt -> bindValue(11, htmlspecialchars($_POST['MailAddress']), PDO::PARAM_STR);
			/*Exposition:説明文*/ $stmt -> bindValue(12, htmlspecialchars($_POST['Exposition']), PDO::PARAM_STR);
			/*PostDate:投稿日*/ $stmt -> bindValue(13, date('Y-m-d'), PDO::PARAM_STR);
			/*StartDate:予約可能開始日*/ $stmt -> bindValue(14, htmlspecialchars($_POST['StartDate']), PDO::PARAM_STR);
			/*StopDate:予約可能終了日*/ $stmt -> bindValue(15, htmlspecialchars($_POST['StopDate']), PDO::PARAM_STR);
			/*UpCancel:投稿状態Flag*/ $stmt -> bindValue(16, '1', PDO::PARAM_STR);	/* 1→投稿中 */
			/*Image1:画像1*/ $stmt -> bindValue(17, $upfile['0'], PDO::PARAM_STR);
			/*Image2:画像2*/ $stmt -> bindValue(18, $upfile['1'], PDO::PARAM_STR);
			/*Image3:画像3*/ $stmt -> bindValue(19, $upfile['2'], PDO::PARAM_STR);
			/*Area:土地の広さ*/ $stmt -> bindValue(20, htmlspecialchars($_POST['Area']), PDO::PARAM_STR);
			/*Electrical:電気○×*/ $stmt -> bindValue(21, htmlspecialchars($_POST['ame_elect']), PDO::PARAM_STR);
			/*Water:水道○×*/ $stmt -> bindValue(22, htmlspecialchars($_POST['ame_water']), PDO::PARAM_STR);
			/*Gas:ガス○×*/ $stmt -> bindValue(23, htmlspecialchars($_POST['ame_gas']), PDO::PARAM_STR);
			/*Toilet:トイレ○×*/ $stmt -> bindValue(24, htmlspecialchars($_POST['ame_toilet']), PDO::PARAM_STR);
			/*BarrierFree:バリアフリー○×*/ $stmt -> bindValue(25, htmlspecialchars($_POST['ame_barrierfree']), PDO::PARAM_STR);
			/*Network:ネットワーク○×*/ $stmt -> bindValue(26, htmlspecialchars($_POST['ame_net']), PDO::PARAM_STR);
			/*Parking:駐車場○×*/ $stmt -> bindValue(27, htmlspecialchars($_POST['ame_parking']), PDO::PARAM_STR);
			/*AirCondition:冷暖房器具○×*/ $stmt -> bindValue(28, htmlspecialchars($_POST['ame_aircon']), PDO::PARAM_STR);
			/*FoodDrink:飲食○×*/ $stmt -> bindValue(29, htmlspecialchars($_POST['ame_food']), PDO::PARAM_STR);
			/*NoFire:火気厳禁○×*/ $stmt -> bindValue(30, htmlspecialchars($_POST['ame_fire']), PDO::PARAM_STR);
			/*CashPayFlag:現金支払Flag*/ $stmt -> bindValue(31, htmlspecialchars($_POST['pay_cash']), PDO::PARAM_STR);
			/*CardPayFlag:カード支払Flag*/ $stmt -> bindValue(32, htmlspecialchars($_POST['pay_card']), PDO::PARAM_STR);
			/*CryptocurrencyPayFlag:暗号通貨支払Flag*/ $stmt -> bindValue(33, htmlspecialchars($_POST['pay_cry']), PDO::PARAM_STR);

			$stmt -> execute();

			$id = $dbh -> lastInsertId('UpID');
			// 受け取ったカテゴリーIDがなくなるまでloop(1件ずつPostCategorysテーブルにinsert)
			foreach ($category as $value) {
				$sql = "insert into PostCategorys(UpID,CategoryID) values(?,?)";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $id, PDO::PARAM_STR);
				$stmt -> bindValue(2, $value, PDO::PARAM_STR);
				$stmt -> execute();
			}


			// [仮]何もエラーがなければ現在時刻を出力
			header("Location: ../php/toukoucomp.php");
			exit;

		}catch(PDOException $e){
			$resMes .= "error";
			echo $resMes;
		}
	}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>施設投稿エラー</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/php/css/sinki.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
<!--     <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="/ajaxzip2/prototype.js"></script>
	<script src="ajaxzip2/ajaxzip2.js" charset="UTF-8"></script> -->
</head>
<body>
	<?php
		require('../php/navbar.php');

		if(!isset($_SESSION['UserName'])){
			header("Location: /php/logincontroller");
			exit;
		}

	?>
	<div class="container">
		<div class="text-center">
			<h3>施設投稿エラー</h3>
			<?php echo $resMes; ?><br>
			<a href="../php/toukou.php">投稿画面に戻る</a>
		</div>
	</div>

</body>
</html>
