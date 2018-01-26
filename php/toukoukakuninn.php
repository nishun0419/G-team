<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, inital-scale=1">
<title> 投稿確認画面</title>
<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
<link rel="stylesheet" type="text/css" href="/php/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/php/css/toukou.css">
<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/php/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/php/js/dispCalendar.js"></script>
<script type="text/javascript" src="/php/js/ajaxzip3.js"></script>
<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	require('navbar.php');
?>
<?php
$page_flag = 0;
if(!empty($_POST['btn_confirm'])){
  $page_flag = 1;
}
 ?>
<?php
if($page_flag === 1):
?>

<?php else: ?>
	<div class="container"><br><br><br>
		<div class="text-center"><h3>投稿確認画面</h3></div>
			<div class="col-md-6 col-md-offset-3">
				<form class="form-horizontal" role="form" method="post" action="../server/toukouserver.php" enctype="multipart/form-data">

					<div class="form-group">

						<!-- <div class="col-md-6"> -->
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">施設名</span>
							<input id="fac_name" type="text" class="form-control" name="FacName" value="<?php echo $_POST['FacName']; ?>" aria-describedby="basic-addon3" readonly required>
						</div>
						<!-- </div> -->
					</div>

					<div class="form-group">

						<!-- <div class="col-md-6"> -->
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">〒</span>
						<input type="text" name="PostNum" class="form-control" pattern="^[0-9]+$" maxlength="3" required value="<?php echo $_POST['zip1']."-".$_POST['zip2'] ?>" readonly>
					</div>
				</div>
				<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon3">都道府県名</span>
					<input type="text" name="Pref" class="form-control" value="<?php echo $_POST['address1'] ?>" size="60" readonly>
				</div>
			</div>
					<div class="form-group">
              		<!-- <div class="col-md-6"> -->
              			<?php 
              			$address = "";
              			// UpIDがない(新規登録)のときはaddress3も
              			if(empty($_POST['UpID'])){
              				$address = $_POST['address2'].$_POST['address3'];
              			}else{
              				$address = $_POST['address2'];
              			}

              			?>
									<div class="input-group">
									<span class="input-group-addon" id="basic-addon3">住所</span>
											<input id="" type="text" class="form-control" name="Address" value="<?php echo $address ?>" aria-describedby="basic-addon3" readonly required >
            			<!-- </div> -->
            			</div>
      				</div>

					<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon3">MAIL</span>
									<input id="MailAddress" type="text" class="form-control" name="MailAddress" value="<?php echo $_POST['MailAddress']; ?>"  aria-describedby="basic-addon3" readonly required>
								</div>
            		</div>

								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon3">電話番号</span>
										<input id="Tel" type="text" class="form-control" name="Tel" value="<?php echo $_POST['Tel']; ?>" aria-describedby="basic-addon3" readonly required>
            		</div>
							</div>


					<div id="test" class="form-group">
						<div class="input-group">
								<span class="input-group-addon" id="basic-addon4">日程</span>
								<input type="text" class="form-control" name="StartDate" value="<?php echo $_POST['StartDate']; ?>" aria-describedby="basic-addon4" readonly required >
								<span class="input-group-addon" id="basic-addon5">～</span>
								<input type="text" class="form-control" name="StopDate" value="<?php echo $_POST['StopDate']; ?>" aria-describedby="basic-addon5" readonly required >
						</div>
					</div>


					<div class="form-group">
						<label for="upload_file" class="">画像添付</label>


						<?php

						$i = 0;
						$dir = '../image/post_image';		// 保存場所のpath
						$upfile = array('','','');	// アップロードファイル保存用の配列
						$errflg = "";
						if( !empty($_FILES['upload_file']['tmp_name'][0]) ){
							$finfo = new finfo(FILEINFO_MIME_TYPE);
							$tmp_name = array();
							$ext = array();
							// 拡張子チェック
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
										echo 'アップロードできる画像形式はpng,jpg,gifです。';
										$errflg = "error";
										break;
								}
							}
							// エラー無ければ
							if(empty($errflg)){
								for($i = 0 ; $i < count($_FILES['upload_file']['tmp_name']) ; $i++){
									// HTTP POSTでアップロードされてるかのチェック
									if(is_uploaded_file($_FILES['upload_file']['tmp_name'][$i])){	
										// TODO:rand
										$fileName = sha1(sha1_file($tmpName[$i]).date('YmdHis')).".".$ext[$i];	//念のため、ファイルからハッシュ生成->ファイル名に
										// ファイルの移動
										if(move_uploaded_file($tmpName[$i], "$dir/$fileName")){
											chmod($dir.'/'.$fileName, 0604);	// パーミッション0604
											$upfile[$i] =  "$fileName";		// DB保存用にファイル名を配列に保存
											echo '<p><img width="50% height="50%" src="', "$dir/$fileName", '"></p>';
										}else{
											$resMes = "画像のアップロードエラー。";
										}
									}else{
										$resMes = "画像のアップロードエラー。";
									}
								}
							}
						}else{
							echo 'ファイル未選択。';
						}

						?>
						<input type="hidden" name="upfile" value="<?php echo implode("\t", $upfile); ?>"/>



					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">説明</span>
							<textarea class=form-control name="Exposition" readonly><?php echo $_POST['Exposition']; ?></textarea>
					</div>
					</div>

					<div id="" class="form-button-group">
						<br><label for="amenity" class=""><h4><strong>アメニティ</strong></h4></label><br>
						<input type="hidden" name="ame_net" value="0"/>
						<input type="hidden" name="ame_elect" value="0"/>
						<input type="hidden" name="ame_water" value="0"/>
						<input type="hidden" name="ame_parking" value="0"/>
						<input type="hidden" name="ame_toilet" value="0"/>
						<input type="hidden" name="ame_gas" value="0"/>
						<input type="hidden" name="ame_barrierfree" value="0"/>
						<input type="hidden" name="ame_food" value="0"/>
						<input type="hidden" name="ame_aircon" value="0"/>
						<input type="hidden" name="ame_fire" value="0"/>
						<?php

							// input属性でnameが指定されてる場合
						if( isset($_POST['Network']) && $_POST['Network'] != "" ){
						  print($_POST['Network']."　");
						  echo '<input type="hidden" name="ame_net" value="1"/>';
						}
						if( isset($_POST['Electrical']) && $_POST['Electrical'] != ""){
						  print($_POST['Electrical']."　");
						  echo '<input type="hidden" name="ame_elect" value="1"/>';
						}
						if( isset($_POST['Water']) && $_POST['Water'] !== ""){
							print($_POST['Water']."　");
							echo '<input type="hidden" name="ame_water" value="1"/>';
						}
						if( isset($_POST['Parking']) && $_POST['Parking'] !==""){
							print($_POST['Parking']."　");
							echo '<input type="hidden" name="ame_parking" value="1"/>';
						}
						if( isset($_POST['Toilet'] )&& $_POST['Toilet'] !==""){
							print($_POST['Toilet']."　");
							echo '<input type="hidden" name="ame_toilet" value="1"/>';
						}
						if( isset($_POST['Gas']) && $_POST['Gas'] !==""){
							print($_POST['Gas']."　");
							echo '<input type="hidden" name="ame_gas" value="1"/>';
						}
						if( isset($_POST['Barrierfree']) && $_POST['Barrierfree'] !==""){
							print($_POST['Barrierfree']."　");
							echo '<input type="hidden" name="ame_barrierfree" value="1"/>';
						}
						if( isset($_POST['FoodDrink']) && $_POST['FoodDrink'] !==""){
							print($_POST['FoodDrink']."　");
							echo '<input type="hidden" name="ame_food" value="1"/>';
						}
						if( isset($_POST['AirCondition']) && $_POST['AirCondition'] !==""){
							print($_POST['AirCondition']);
							echo '<input type="hidden" name="ame_aircon" value="1"/>';
						}
						if( isset($_POST['NoFire']) && $_POST['NoFire'] !==""){
							print($_POST['NoFire']."　");
							echo '<input type="hidden" name="ame_fire" value="1"/>';
						}
						?>


					</div>


					<div id="" class="form-button-group">
						<br><label for="id" class=""><h4><strong>カテゴリー</strong></h4></label><br>

						<?php
							// input属性でnameが配列の場合
							$kategory = $_POST['kategory'];
							for($i=0; $i<=10; $i++){
								if( isset($kategory[$i]) && $kategory[$i] !=="" ){
									print($kategory[$i]."　");
									echo '<input type="hidden" name="cate[]" value="',$i+1,'"/>';
								}
							}
						?>


					</div>
					<br>
					<div id="test" class="form-group">
						<div class="input-group">
								<span class="input-group-addon" id="basic-addon4">人数</span>
							<input  type="text" class="form-control" name="PeopleNum" value="<?php echo $_POST['PeopleNum']; ?>" aria-describedby="basic-addon4" readonly required >
								<span class="input-group-addon" id="basic-addon2">人</span>
						</div>
					</div>

					<div id="test" class="form-group">
						<div class="input-group">
								<span class="input-group-addon" id="basic-addon4">広さ</span>
												<input type="text" class="form-control" name="Area" value="<?php echo $_POST['Area']; ?>" aria-describedby="basic-addon4" readonly required >
												<span class="input-group-addon" id="basic-addon2">m&#178;</span>
											</div>
										</div>
										<div id="test" style="width:150pxS" class="form-group">
											<div class="input-group">
												<span class="input-group-addon" id="basic-addon4">料金</span>
												<input type="text" class="form-control" name="Price" value="<?php echo $_POST['Price']; ?>"  aria-describedby="basic-addon4"  readonly  required >
							<span class="input-group-addon" id="basic-addon2">円</span>
						</div>
					</div>

					<div id="check" class="form-button_group">
							<br><label  class=""><h4><strong>支払い方法</strong></h4></label><br>
							<input type="hidden" name="pay_cash" value="0"/>
							<input type="hidden" name="pay_card" value="0"/>
							<input type="hidden" name="pay_cry" value="0">
						<?php
						if( isset($_POST['pay_cash']) && $_POST['pay_cash'] != "" ){
							print($_POST['pay_cash']."　");
							echo '<input type="hidden" name="pay_cash" value="1"/>';
							}
						if( isset($_POST['pay_card']) && $_POST['pay_card'] != "" ){
								print($_POST['pay_card']."　");
								echo '<input type="hidden" name="pay_card" value="1"/>';
							}
						if( isset($_POST['pay_cry']) && $_POST['pay_cry'] != "" ){
								print($_POST['pay_cry']."　");
								echo '<input type="hidden" name="pay_cry" value="1"/>';
							}
						?>

					 </div>
					 <br>
	<div class="text-center"><h3><strong>この内容で投稿しますか？</strong></h3></div>

			<div class="button-group text-center">

			<?php
				$UpID = "";
				if(isset($_POST['UpID'])){
					$UpID = htmlspecialchars($_POST['UpID']);
				}
			?>

					<input type="hidden" id="facilityIdent">
					<input type="hidden" id="userid">
					<input type="hidden" id="UpID" name="UpID" value="<?php echo $UpID; ?>">
					<button type="submit" class="btn btn-default cancel" formaction="mypage.php" formnovalidate>キャンセル</button>
					<button type="submit" class="btn btn-primary ok">登録する</button>

			</div>

				</form>
		</div>
</div>

<script type="text/javascript" src="/php/js/gazou1.js"></script>
<?php endif; ?>
</body>
</html>
