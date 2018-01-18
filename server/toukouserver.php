<?php

header("Content-Type:text/html;charset=UTF-8");
session_start();
$resMes = "";

$dir = '../image/post_image';		// 保存場所のpath
$upfile = array('','','');	// アップロードファイル保存用の配列
$res = array();				// 緯度経度保存用の配列

// ログイン済か否か
if(!isset($_SESSION['UserID'])){
	$resMes = "UserIDがありません。";
}
// ファイルのアップロード(ファイルがない場合は無視,4つ以上の場合エラー)
elseif( count($_FILES['upload_file']['tmp_name']) > 3 ){
	$resMes = "アップロードできるファイルは3つまでです。";
}else{

	// バリデーションチェック
	// 必須項目確認
	if(!isset($_POST['fac_name']) || !isset($_POST['fac_zip']) || !isset($_POST['fac_address']) || !isset($_POST['fac_email']) || !isset($_POST['fac_tel']) || !isset($_POST['people']) || !isset($_POST['date_from']) || !isset($_POST['date_to']) || !isset($_POST['fac_area']) || !isset($_POST['price']) ){
		$resMes .= "必要項目が入力されていません。";
	}
	
	// 施設名の長さチェック
	elseif(mb_strlen($_POST['fac_name']) > 64){
		$resMes .= "施設名が長すぎます。";
	}
	// 郵便番号の形式チェック
	elseif(!preg_match('/^\d{3}\-\d{4}$/', $_POST['fac_zip'])){
		$resMes .= "郵便番号は半角数字と半角ハイフンで入力してください。";
	}
	// 住所の長さチェック
	elseif(mb_strlen($_POST['fac_address']) > 80){
		$resMes .= "住所が長すぎます。";
	}
	// メールアドレスの形式・長さチェック
	elseif(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $_POST['fac_email'])){
		$resMes .= "メールアドレスは正しく入力してください。";
	}
	elseif(mb_strlen($_POST['fac_email']) > 80){
		$resMes .= "メールアドレスが長すぎます。";
	}
	// 電話番号の形式・長さチェック
	elseif(!preg_match('/^[0-9-]+$/', $_POST['fac_tel'])){
		$resMes .= "電話番号は半角数字と半角ハイフンで入力してください。";
	}
	elseif(mb_strlen($_POST['fac_tel']) > 20) {
		$resMes .= "電話番号が長すぎます。";
	}
	// 人数の形式・長さチェック
	elseif(!preg_match('/^[0-9]+$/', $_POST['people'])){
		$resMes .= "人数は半角数字で入力してください。";
	}
	elseif(mb_strlen($_POST['people']) > 5){
		$resMes .= "人数が多すぎます。";
	}
	// 日付の形式(長さ)チェック
	elseif(!preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}+$/', $_POST['date_from']) || !preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}+$/', $_POST['date_to'])){
		$resMes .= "日付は正しく入力してください。";
	}
	// 土地広さの形式・長さチェック
	elseif(!preg_match('/^[0-9.]+$/', $_POST['fac_area'])){
		$resMes .= "土地の広さは半角数字で入力してください。";
	}
	elseif(mb_strlen($_POST['fac_area']) > 10){
		$resMes .= "土地の広さが大きすぎます。";
	}
	// 説明文の長さチェック
	elseif(mb_strlen($_POST['fac_text']) > 1000){
		$resMes .= "説明文は1000文字以内で入力してください。";
	}
	// カテゴリーの選択チェック
	elseif(!isset($_POST['cate'])){
		$resMes .= "カテゴリーは一つ以上選択してください。";
	}
	// 料金の形式(長さ)チェック
	elseif(!preg_match('/^[0-9]{1,10}+$/', $_POST['price'])){
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
		$address = $_POST['fac_address'];
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

	// エラーなし&ファイルが選択されてる場合(選択されてなければスルー)
	if( empty($resMes) && !empty($_FILES['upload_file']['tmp_name'][0]) ){
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$tmp_name = array();
		$ext = array();
		// 拡張子チェック(png,jpg,gif以外はアウト)
		for($i = 0 ; $i < count($_FILES['upload_file']['tmp_name']) ; $i++){
			$tmpName[$i] = $_FILES['upload_file']['tmp_name'][$i];
			$mime_type = $finfo->file($tmpName[$i]);
			switch ($mime_type) {
				case "image/png":
					$ext[$i] = "png";
					break;
				case "image/jpeg":
					$ext[$i] = "jpg";
					break;
				case "image/gif":
					$ext[$i] = "gif";
					break;
				default:
					$resMes = "アップロードできる画像形式はpng,jpg,gifです。";
			}
		}
		// 拡張子エラーがない(resMesが空の)場合、画像のアップロードに移る
		if(empty($resMes)){
			for($i = 0 ; $i < count($_FILES['upload_file']['tmp_name']) ; $i++){
				// HTTP POSTでアップロードされてるかのチェック
				if(is_uploaded_file($_FILES['upload_file']['tmp_name'][$i])){	
					// TODO:rand
					$fileName = sha1(sha1_file($tmpName[$i]).date('YmdHis')).".".$ext[$i];	//念のため、ファイルからハッシュ生成->ファイル名に
					// ファイルの移動
					if(move_uploaded_file($tmpName[$i], "$dir/$fileName")){
						chmod($dir.'/'.$fileName, 0604);	// パーミッション0604
						$upfile[$i] =  "$fileName";		// DB保存用にファイル名を配列に保存
					}else{
						$resMes = "画像のアップロードエラー。";
					}
				}else{
					$resMes = "画像のアップロードエラー。";
				}
			}
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
			$sql = "insert into Posts(UserID,FacName,Price,PostNum,Address,Lat,Lon,PeopleNum,Tel,MailAddress,Exposition,PostDate,StartDate,StopDate,UpCancel,Image1,Image2,Image3,Area,Electrical,Water,Gas,Toilet,BarrierFree,Network,Parking,AirCondition,FoodDrink,NoFire,CashPayFlag,CardPayFlag,CryptocurrencyPayFlag,Pref) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
			/*PostDate:投稿日*/ $stmt -> bindValue(12, date('Y-m-d'), PDO::PARAM_STR);
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
										$stmt -> bindValue(33, '兵庫県', PDO::PARAM_STR);

			$row = $stmt -> execute();		//エラー確認
			if(!$row){
				echo "error";
				exit;
			}

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
			$resMes = date('YmdHis');

		}catch(PDOException $e){
			$resMes .= "error";
			echo $resMes;
		}
	}

}
echo $resMes;