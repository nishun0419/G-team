<?php

header("Content-Type:text/html;charset=UTF-8");
session_start();
$resMes = "";

$dir = '../image';			// TODO:応相談、保存場所のpath
$upfile = array('','','');	// アップロードファイル保存用の配列
$res = array();				// 緯度経度保存用の配列

// ファイルのアップロード(ファイルがない場合は無視)
if( $_FILES['upload_file']['size'] != 0){
	for($i = 0 ; $i < count($_FILES['upload_file']['tmp_name']) ; $i++){
		$tmpName = $_FILES['upload_file']['tmp_name'][$i];
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mime_type = $finfo->file($tmpName);
		// 拡張子チェック
		$ext = "";
		switch ($mime_type) {
			case "image/png":
				$ext = "png";
				break;
			case "image/jpeg":
				$ext = "jpg";
				break;
			case "image/gif":
				$ext = "gif";
				break;
			default:
				$resMes .= "画像はpng,jpg,gifのどれかをアップロードしてください。";
				break;
		}
		if(is_uploaded_file($_FILES['upload_file']['tmp_name'][$i])){	
			$fileName = md5_file($_FILES['upload_file']['tmp_name'][$i]).".".$ext;	//念のため、ファイルからハッシュ生成->ファイル名に
			if(move_uploaded_file($tmpName, "$dir/$fileName")){
				chmod($dir.'/'.$fileName, 0604);
				$upfile[$i] =  "$dir/$fileName";
			}else{
				$resMes .= "アップロードエラー。";
			}
		}else{
			$resMes .= "ファイル未選択。";
		}
	}
}

// TODO:バリデーションチェック(未完成)
if(!isset($_SESSION['UserID'])){
	$resMes .= "UserIDがありません。";
}
// 必須項目確認
elseif(!isset($_POST['fac_name']) || !isset($_POST['fac_zip']) || !isset($_POST['fac_address']) || !isset($_POST['fac_email']) || !isset($_POST['fac_tel']) || !isset($_POST['people']) || !isset($_POST['date_from']) || !isset($_POST['date_to']) || !isset($_POST['fac_area']) || !isset($_POST['price']) ){
	$resMes .= "必要項目が入力されていません。";
}
// チェックボックス選択確認
elseif( !($_POST['pay_cash'] == 1 || $_POST['pay_card'] == 1 || $_POST['pay_cry'] == 1) ){
	$resMes .= "支払い方法は一つ以上選択してください。";
}
elseif(!isset($_POST['cate'])){
	$resMes .= "カテゴリーは一つ以上選択してください。";
}
// アップロード上限確認
elseif( count($_FILES['upload_file']['tmp_name']) > 3 ){
	$resMes .= "アップロードできるファイルは3つまでです。";
}
// その他、個々の項目チェック
elseif(!preg_match('/^\d{3}\-\d{4}$/', $_POST['fac_zip'])){
	$resMes .= "郵便番号は半角数字と半角ハイフンで入力してください。";
}
elseif(!preg_match('/^[0-9-]+$/', $_POST['fac_tel'])){
	$resMes .= "電話番号は半角数字と半角ハイフンで入力してください。";
}
elseif(!preg_match('/^[0-9]+$/', $_POST['people'])){
	$resMes .= "人数は半角数字で入力してください。";
}
elseif(!preg_match('/^[0-9\/]+$/', $_POST['date_from']) || !preg_match('/^[0-9\/]+$/', $_POST['date_to'])){
	$resMes .= "日付は正しく入力してください。";
}
elseif(!preg_match('/^[0-9\.]+$/', $_POST['fac_area'])){
	$resMes .= "土地の広さは半角数字で入力してください。";
}
elseif(mb_strlen($_POST['fac_text']) > 1000){
	$resMes .= "説明文は1000文字以内で入力してください。";
}
elseif(!preg_match('/^[0-9]+$/', $_POST['price'])){
	$resMes .= "料金は半角数字で入力してください。";
}

// バリデーションチェックここまで
elseif(empty($resMes)){

	// 住所から緯度経度を計算
	$address = $_POST['fac_address'];
	$req = 'http://maps.google.com/maps/api/geocode/xml?address='.urlencode($address).'&sensor=false';
	$xml = simplexml_load_file($req) or die('XML parsing error');
	if ($xml->status == 'OK') {
		$location = $xml->result->geometry->location;
		$res['lat'] = (string)$location->lat[0];
		$res['lng'] = (string)$location->lng[0];
	}


	// 受け取ったカテゴリーIDを配列に挿入
	$category  = $_POST['cate'];

	// DBに接続
	$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
	$user = "kobe";
	$password = "denshi";

	try{

		// date取得
		$today = getdate();
		$d = $today['mday'];
		$m = $today['mon'];
		$y = $today['year'];

		// PDOで接続
		$dbh = new PDO($dsn, $user, $password);

		// Postテーブルにinsert
		$sql = "insert into Posts(UserID,FacName,Price,PostNum,Address,lat,lon,PeopleNum,Tel,MailAddress,Exposition,PostDate,StartDate,StopDate,UpCancel,Image1,Image2,Image3,Area,Electrical,Water,Gas,Toilet,BarrierFree,Network,Parking,AirCondition,FoodDrink,NoFire,CashPayFlag,CardPayFlag,CryptocurrencyPayFlag) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $dbh -> prepare($sql);
		/*UserID:ユーザID*/ $stmt -> bindValue(1, unserialize($_SESSION['UserID']), PDO::PARAM_STR);
		/*FacName:施設名*/ $stmt -> bindValue(2, htmlspecialchars($_POST['fac_name']), PDO::PARAM_STR);
		/*Price:料金*/ $stmt -> bindValue(3, htmlspecialchars($_POST['price']), PDO::PARAM_STR);
		/*PostNum:郵便番号*/ $stmt -> bindValue(4, htmlspecialchars($_POST['fac_zip']), PDO::PARAM_STR);
		/*Address:住所*/ $stmt -> bindValue(5, htmlspecialchars($_POST['fac_address']), PDO::PARAM_STR);
		/*lat:緯度*/ $stmt -> bindValue(6, $res['lat'], PDO::PARAM_STR);
		/*lon:経度*/ $stmt -> bindValue(7, $res['lng'], PDO::PARAM_STR);
		/*PeopleNum:収容人数*/ $stmt -> bindValue(8, htmlspecialchars($_POST['people']), PDO::PARAM_STR);
		/*Tel:電話番号*/ $stmt -> bindValue(9, htmlspecialchars($_POST['fac_tel']), PDO::PARAM_STR);
		/*MailAddress:メール*/ $stmt -> bindValue(10, htmlspecialchars($_POST['fac_email']), PDO::PARAM_STR);
		/*Exposition:説明文*/ $stmt -> bindValue(11, htmlspecialchars($_POST['fac_text']), PDO::PARAM_STR);
		/*PostDate:投稿日*/ $stmt -> bindValue(12, $y.'-'.$m.'-'.$d, PDO::PARAM_STR);
		/*StartDate:予約可能開始日*/ $stmt -> bindValue(13, htmlspecialchars($_POST['date_from']), PDO::PARAM_STR);
		/*StopDate:予約可能終了日*/ $stmt -> bindValue(14, htmlspecialchars($_POST['date_to']), PDO::PARAM_STR);
		/*UpCancel:投稿状態Flag*/ $stmt -> bindValue(15, '1', PDO::PARAM_STR);	/* 1→投稿中 */
		/*Image1:画像1*/ $stmt -> bindValue(16, $upfile['0'], PDO::PARAM_STR);
		/*Image2:画像2*/ $stmt -> bindValue(17, $upfile['1'], PDO::PARAM_STR);
		/*Image3:画像3*/ $stmt -> bindValue(18, $upfile['2'], PDO::PARAM_STR);
		/*Area:土地の広さ*/ $stmt -> bindValue(19, htmlspecialchars($_POST['fac_area']), PDO::PARAM_STR);
		/*Electrical:電気○×*/ $stmt -> bindValue(20, htmlspecialchars($_POST['ame_elect']), PDO::PARAM_STR);
		/*Water:水道○×*/ $stmt -> bindValue(21, htmlspecialchars($_POST['ame_water']), PDO::PARAM_STR);
		/*Gas:ガス○×*/ $stmt -> bindValue(22, htmlspecialchars($_POST['ame_gas']), PDO::PARAM_STR);
		/*Toilet:トイレ○×*/ $stmt -> bindValue(23, htmlspecialchars($_POST['ame_toilet']), PDO::PARAM_STR);
		/*BarrierFree:バリアフリー○×*/ $stmt -> bindValue(24, htmlspecialchars($_POST['ame_barrierfree']), PDO::PARAM_STR);
		/*Network:ネットワーク○×*/ $stmt -> bindValue(25, htmlspecialchars($_POST['ame_net']), PDO::PARAM_STR);
		/*Parking:駐車場○×*/ $stmt -> bindValue(26, htmlspecialchars($_POST['ame_parking']), PDO::PARAM_STR);
		/*AirCondition:冷暖房器具○×*/ $stmt -> bindValue(27, htmlspecialchars($_POST['ame_aircon']), PDO::PARAM_STR);
		/*FoodDrink:飲食○×*/ $stmt -> bindValue(28, htmlspecialchars($_POST['ame_food']), PDO::PARAM_STR);
		/*NoFire:火気厳禁○×*/ $stmt -> bindValue(29, htmlspecialchars($_POST['ame_fire']), PDO::PARAM_STR);
		/*CashPayFlag:現金支払Flag*/ $stmt -> bindValue(30, htmlspecialchars($_POST['pay_cash']), PDO::PARAM_STR);
		/*CardPayFlag:カード支払Flag*/ $stmt -> bindValue(31, htmlspecialchars($_POST['pay_card']), PDO::PARAM_STR);
		/*CryptocurrencyPayFlag:暗号通貨支払Flag*/ $stmt -> bindValue(32, htmlspecialchars($_POST['pay_cry']), PDO::PARAM_STR);

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

		// [仮]何もエラーがなければtextareaに入力した値を出力
		$resMes = $_POST['fac_text'];

	}catch(PDOException $e){
		$resMes .= "error";
		echo $resMes;
	}
}

echo $resMes;