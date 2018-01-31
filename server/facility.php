<?php
	// session_start();
	// if(!isset($_SESSION["userid"])){
	// 	header('Location: ../php/login.php');
	// 	exit;
	// }

	$dsn = "mysql:dbname=teamG;host=localhost;charset=utf8";
	$user = "kobe";
	$password = "denshi";
	try{
		$dbh = new PDO($dsn,$user,$password);
		if($_GET["process"] === "top"){
			$sql = "select * from Posts";
			$stmt=$dbh->prepare($sql);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array( "UpID" => $row["UpID"],
								"FacName" => $row["FacName"],
								"PostNum" => $row["PostNum"],
								"Address" => $row["Address"],
								"Exposition" => $row["Exposition"],
								"PeopleNum" => $row["PeopleNum"],
								"image" => $row["Image1"],
								"Price" => $row["Price"]
						);
			}
		}
		else if($_GET["process"] === "serch"){//位置情報を使わない普通の検索
			$para = htmlspecialchars($_GET["keyword"]);
			$area = htmlspecialchars($_GET["area"]);
			$minwidth = htmlspecialchars($_GET["minwidth"]);
			$maxwidth = htmlspecialchars($_GET["maxwidth"]);
			if(isset($_GET["infras"])){
			$infras = $_GET["infras"];
			}
			$y = 1; //bindValueの添え字
			$sql = "select * from Posts where UpCancel = ?";
			if(isset($para) && $para !== null && $para !== "" ){
			//キーワードがあるときの処理

				$keyword = trim(htmlspecialchars($para));	//前後の空白をなくす
				$dates = mb_convert_kana($keyword, 's');//全角スペースを半角キーワードに変える
				if(strpos($dates, ' ') !== false){//キーワードの中にスペースがあった時の処理

					$keywords = explode(' ',$dates);//スペースごとに分割する
					$count = count($keywords);	//配列の長さ
					for($i = 0; $i < $count; $i++){
						$sql = $sql."and (FacName like ? or Exposition like ?) ";
					}
				}
				else{	//スペースがないとき
						$sql = $sql."and (FacName like ? or Exposition like ?) ";
						$keywords[0] = $dates;
				}

			}
			else{}

			if(isset($area) && $area !== null && $area !== ""){
				$areaflag = true;
				//エリア指定があるときの処理
				$sql = $sql."and Pref like ?";
				
			}
			else{}

			if(isset($infras) && is_array($infras)){
				$infraflag = true;
				$sql = $sql."and ";
				for($i = 0; $i < count($infras); $i++){
					if($i > 0){
						$sql = $sql."and ";
					}
					$infra = htmlspecialchars($infras[$i]);

					if($infra === "1"){
						$sql = $sql."Electrical = ? ";
					}
					else if($infra === "2"){
						$sql = $sql."Water = ? ";
					}
					else if($infra === "3"){
						$sql = $sql."Gas = ? ";
					}
					else if($infra === "4"){
						$sql = $sql."Toilet = ? ";
					}
					else if($infra === "5"){
						$sql = $sql."BarrierFree = ? ";
					}
					else if($infra === "6"){
						$sql = $sql."Network = ? ";
					}
					else if($infra === "7"){
						$sql = $sql."Parking = ? ";
					}
					else if($infra === "8"){
						$sql = $sql."AirCondition = ? ";
					}
					else if($infra === "9"){
						$sql = $sql."FoodDrink = ? ";
					}
					else if($infra === "10"){
						$sql = $sql."NoFire = ? ";
					}
				}
			}
			else{}

			if($minwidth || $maxwidth){
				$sql = $sql."and ";
				if($minwidth && $maxwidth){
					$minmaxflag = true;
					$sql = $sql. "Area between ? and ?";
				}
				elseif($minwidth){
					$minflag = true;
					$sql = $sql."Area >= ? ";
				}
				elseif($maxwidth){
					$maxflag = true;
					$sql = $sql. "Area <= ?";
				}
			}
			else{}	
			$stmt = $dbh -> prepare($sql);
			//Upcancel
			$stmt -> bindValue($y, '1', PDO::PARAM_STR);
			$y++;
			if(isset($keywords)){
				for($i = 0; $i < count($keywords); $i++){
					$stmt -> bindValue($y, '%'.$keywords[$i].'%', PDO::PARAM_STR);
					$stmt -> bindValue($y + 1, '%'.$keywords[$i].'%', PDO::PARAM_STR);
					$y = $y + 2;
				}

			}
			else{}//キーワードがなかった時

			if(isset($areaflag)){
				$stmt -> bindValue($y, '%'.$area.'%', PDO::PARAM_STR);
				$y++;
			}
			else{}//エリア指定がなかった時の処理

			if(isset($infraflag)){
				for($i = 0; $i < count($infras); $i++){
					$stmt -> bindValue($y, true, PDO::PARAM_INT);
					$y++;
				}
			}
			else{}//インフラ指定がなかった時の処理

			if(isset($minmaxflag)){
				$minwidth=(float)$minwidth;
				$maxwidth = (float)$maxwidth;
				$stmt -> bindValue($y, $minwidth, PDO::PARAM_INT);
				$stmt -> bindValue($y + 1, $maxwidth, PDO::PARAM_INT);
				$y + 2;
			}
			elseif(isset($minflag)){
				$minwidth = (float)$minwidth;
				$stmt -> bindValue($y, $minwidth, PDO::PARAM_INT);
				$y++;
			}
			elseif(isset($maxflag)){
				$maxwidth = (float)$maxwidth;
				$stmt -> bindValue($y, $maxwidth, PDO::PARAM_INT);
				$y++;
			}
			
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array( "UpID" => $row["UpID"],
								"FacName" => $row["FacName"],
								"PostNum" => $row["PostNum"],
								"Pref" => $row["Pref"],
								"Address" => $row["Address"],
								"Exposition" => $row["Exposition"],
								"PeopleNum" => $row["PeopleNum"],
								"image" => $row["Image1"],
								"Price" => $row["Price"]
						);
			}
		}
		else if($_GET["process"] === "detail"){ //施設詳細情報の処理
			$sql = "select * from Posts where UpID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["ident"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from Reservations where UpID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $row["UpID"], PDO::PARAM_STR);
				$stmt -> execute();
				$index = 0;
				$orderdate = null;
				//予約されている日付を格納
				while($rrow = $stmt -> fetch(PDO::FETCH_ASSOC)){
					$sql = "select * from ResDates where ResID = ?";
					$rstmt = $dbh -> prepare($sql);
					$rstmt -> bindValue(1,$rrow["ResID"], PDO::PARAM_INT);
					$rstmt -> execute();
					while($ReserData = $rstmt -> fetch(PDO::FETCH_ASSOC)){
						$orderdate[$index] = $ReserData["Reservation"];
						$index++;
					}
				}
				//画像を配列に格納
				$images[0] = $row["Image1"];
				$images[1] = $row["Image2"];
				$images[2] = $row["Image3"];
				
				//インフラの情報を格納する(詳細画面に必要なため)
				$infra_label[0] = $row["Electrical"];
				$infra_label[1] = $row["Water"];
				$infra_label[2] = $row["Gas"];
				$infra_label[3] = $row["Toilet"];
				$infra_label[4] = $row["BarrierFree"];
				$infra_label[5] = $row["Network"];
				$infra_label[6] = $row["Parking"];
				$infra_label[7] = $row["AirCondition"];
				$infra_label[8] = $row["FoodDrink"];
				$infra_label[9] = $row["NoFire"];

				//StartDateが過去の場合StartDateを今日にする
				if(strtotime($row["StartDate"]) < strtotime(date('Y-m-d'))){
					$StartDate = date('Y-m-d');
				}
				else{
					$StartDate = $row["StartDate"];
				}

				$res[] = array( "UpID" => $row["UpID"],
								"FacName" => $row["FacName"],
								"PostNum" => $row["PostNum"],
								"Address" => $row["Address"],
								"Pref" => $row["Pref"],
								"Exposition" => $row["Exposition"],
								"PeopleNum" => $row["PeopleNum"],
								"images" => $images,
								"Price" => $row["Price"],
								"StartDate" => $StartDate,
								"StopDate" => $row["StopDate"],
								"orderdate" => $orderdate,
								"infraLabel" => $infra_label,
								"Area" => $row["Area"]
						);
			}
		}
		else if($_GET["process"] === "info_Check"){//予約前の情報確認用の処理
			$sql = "select * from Posts where UpID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["ident"], PDO::PARAM_INT);
			$stmt -> execute();
			$res = array();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from Users where UserID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $_GET["userid"], PDO::PARAM_STR);
				$stmt -> execute();
				$urow = $stmt -> fetch(PDO::FETCH_ASSOC);
				if($urow){
					$res[] = array("UpID" => $row["UpID"],
								   "FacName" => $row["FacName"],
								   "PostNum" => $row["PostNum"],
								   "Address" => $row["Address"],
								   "Pref" => $row["Pref"],
								   "Price" => $row["Price"],
								   "FullName" => $urow["FamilyName"].$urow["GivenName"]
								);
				}
			}

		}
		else if($_GET["process"] === "mypage"){	//マイページ上に表示する投稿リスト用の処理	
			$sql = "select * from Posts where UserID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["userid"], PDO::PARAM_STR);
			$res = array();
			$stmt -> execute();

			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array("FacName" => $row["FacName"],
							   "PostNum" => $row["PostNum"],
							   "Address" => $row["Address"],
							   "Pref" => $row["Pref"],
							   "Image" => $row["Image1"],
							   "UpID" =>  $row["UpID"],
							   "UpCancel" => $row["UpCancel"]
						);
			}

		}

		else if($_GET["process"] === "checkOrder"){//予約状況確認用の処理
			$sql = "select * from Posts where UpID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["ident"], PDO::PARAM_STR);
			$res = array();
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$facname = $row["FacName"];
				$sql = "select * from Reservations where UpID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $_GET["ident"], PDO::PARAM_STR);
				$orderdate = null;
				$index = 0;
				$stmt -> execute(); 
				while($rrow = $stmt -> fetch(PDO::FETCH_ASSOC)){
					$sql = "select * from ResDates where ResID = ?";
					$rstmt = $dbh -> prepare($sql);
					$rstmt -> bindValue(1, $rrow["ResID"], PDO::PARAM_INT);
					$rstmt -> execute();
					while($resrow = $rstmt -> fetch(PDO::FETCH_ASSOC)){
						$orderdate[$index] = $resrow["Reservation"];
						$index++;
				}
			}
			$res[] = array("FacName" => $facname,
							"orderdate" => $orderdate
						);
			}
		}

		else if($_GET["process"] === "edit_post"){
			$sql = "select * from Posts where UpID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["UpID"], PDO::PARAM_STR);
			$res = array();
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from PostCategorys where UpID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $_GET["UpID"], PDO::PARAM_STR);
				$stmt -> execute();
				$categorys = null;
				$index = 0;
				while($caterow = $stmt -> fetch(PDO::FETCH_ASSOC)){
					$categorys[$index] = $caterow["CategoryID"];
					$index++;
				}
				$infraarray = null;
				//インフラ情報を配列に格納
				$infraarray[0] = $row["Network"];
				$infraarray[1] = $row["Electrical"];
				$infraarray[2] = $row["Water"];
				$infraarray[3] = $row["Parking"];
				$infraarray[4] = $row["Toilet"];
				$infraarray[5] = $row["Gas"];
				$infraarray[6] = $row["BarrierFree"];
				$infraarray[7] = $row["FoodDrink"];
				$infraarray[8] = $row["AirCondition"];
				$infraarray[9] = $row["NoFire"];

				$Payarray = null;
				//支払い情報を配列に格納
				$Payarray[0] = $row["CashPayFlag"];
				$Payarray[1] = $row["CardPayFlag"];
				$Payarray[2] = $row["CryptocurrencyPayFlag"];

				//郵便番号をハイフン無しにする
				$postnum = explode("-",$row["PostNum"]);

				//$resに必要な情報を格納
				$res[] = array("FacName" => $row["FacName"],
							   "zip1" => $postnum[0],
							   "zip2" => $postnum[1],
							   "Pref" => $row["Pref"],
							   "Address" => $row["Address"],
							   "PeopleNum" => $row["PeopleNum"],
							   "Tel" => $row["Tel"],
							   "MailAddress" => $row["MailAddress"],
							   "Exposition" => $row["Exposition"],
							   "Price" => $row["Price"],
							   "StartDate" => $row["StartDate"],
							   "StopDate" => $row["StopDate"],
							   "Area" => $row["Area"],
							   "Infras" => $infraarray,
							   "Categorys" =>$categorys,
							   "Pays" => $Payarray 
							);
			}
		}

		header("Access-Control-Allow-Origin:*");
		header("Content-Type: application/json");
		echo json_encode($res);
		exit;
	}catch(PDOException $e){
		$res[] = array("title" => $e);
		echo json_encode($res);

	}
?>