<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset="UTF-8" content="">
<meta name="viewport">
<title>施設情報編集</title>
<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
<link rel="stylesheet" type="text/css" href="/php/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/php/css/toukou.css">
<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/php/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/php/js/dispCalendar.js"></script>
<script type="text/javascript" src="/php/js/checkbox1.js"></script>
<script type="text/javascript" src="/php/js/ajaxzip3.js"></script>
</head>
<body>
<?php
	require('navbar.php');
	if(!isset($_SESSION['UserName'])){
		header("Location: /php/logincontroller");
		exit;
	}
/*	if(($_SESSION['flag'])){
		header("Location: /mypage.php");
	}*/
?>
<script type="text/javascript">
	var UpID = '<?php echo htmlspecialchars($_GET["UpID"]) ?>';
</script>
	<div class="container"><br><br><br>
		<div class="text-center"><h3>施設情報編集</h3></div>
			<div class="col-md-6 col-md-offset-3">
				<form class="form-horizontal" role="form" method="post" action="toukoukakuninn.php" enctype="multipart/form-data">

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">施設名</span>
							<input id="fac_name" type="text" class="form-control" name="FacName" required value="" placeholder="施設名登録">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
                <span class="input-group-addon" id="basic-addon3">〒</span>
              <input type="text" id="zip1" name="zip1" class="form-control" pattern="^[0-9]+$" maxlength="3" required value="" >
                <span class="input-group-addon" id="basic-addon5">-</span>
              <input type="text" id="zip2" name="zip2" class="form-control" onKeyUp="AjaxZip3.zip2addr('zip1','zip2','address1','address2');" pattern="^[0-9]+$" maxlength="4" required value="">
            </div>
          </div>
          <div id="test"class="form-group">
            <div class="input-group">
      <span class="input-group-addon" id="basic-addon3">都道府県</span>
      <input type="text" name="address1" class="form-control"　size="60" readonly>
      <!--
          <select name="address1">

              <option value="">-- 選択してください --</option>
              <option value="01">北海道</option>
              <option value="02">青森県</option>
              <option value="03">岩手県</option>
              <option value="04">宮城県</option>
              <option value="05">秋田県</option>
              <option value="06">山形県</option>
              <option value="07">福島県</option>
              <option value="08">茨城県</option>
              <option value="09">栃木県</option>
              <option value="10">群馬県</option>
              <option value="11">埼玉県</option>
              <option value="12">千葉県</option>
              <option value="13">東京都</option>
              <option value="14">神奈川県</option>
              <option value="15">新潟県</option>
              <option value="16">富山県</option>
              <option value="17">石川県</option>
              <option value="18">福井県</option>
              <option value="19">山梨県</option>
              <option value="20">長野県</option>
              <option value="21">岐阜県</option>
              <option value="22">静岡県</option>
              <option value="23">愛知県</option>
              <option value="24">三重県</option>
              <option value="25">滋賀県</option>
              <option value="26">京都府</option>
              <option value="27">大阪府</option>
              <option value="28">兵庫県</option>
              <option value="29">奈良県</option>
              <option value="30">和歌山県</option>
              <option value="31">鳥取県</option>
              <option value="32">島根県</option>
              <option value="33">岡山県</option>
              <option value="34">広島県</option>
              <option value="35">山口県</option>
              <option value="36">徳島県</option>
              <option value="37">香川県</option>
              <option value="38">愛媛県</option>
              <option value="39">高知県</option>
              <option value="40">福岡県</option>
              <option value="41">佐賀県</option>
              <option value="42">長崎県</option>
              <option value="43">熊本県</option>
              <option value="44">大分県</option>
              <option value="45">宮崎県</option>
              <option value="46">鹿児島県</option>
              <option value="47">沖縄県</option>
          </select>
      -->
    <span class="input-group-addon" id="basic-addon3">市区町村</span>
      <input type="text" name="address2" class="form-control" size="60" readonly>
    </div>
  </div>
  <div id="test"　class="form-group">
    <div class="input-group">
<span class="input-group-addon" id="basic-addon3">番地</span>
    <input type="text" name="address3" class="form-control">
    </div>
  </div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">MAIL</span>
            	<input id="fac_email" type="text" class="form-control" name="MailAddress" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required value=""  placeholder="メール">
            </div>
          </div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">電話番号</span>
							<input id="fac_tel" type="text" class="form-control" name="Tel" pattern="\d{2,4}-\d{3,4}-\d{3,4}" required 　value=""maxlength="14" placeholder="0000-0000-0000">
            </div>
          </div>



					<div id="test"　class="form-group">
						<div class="input-group">
			  				<span class="input-group-addon" id="basic-addon4">日程</span>
        				<input type="text" class="form-control" id="datepickerFrom" name="StartDate" required  placeholder="クリックして下さい"/>
								<span class="input-group-addon" id="basic-addon5">～</span>
								<input type="text" class="form-control" id="datepickerTo" name="StopDate" required  placeholder="クリックして下さい"/>
					</div>
				</div>
					<div class="form-group">
						<div class="input-group">
						<span class="input-group-addon" id="basic-addon4" for="upload_file">画像添付</span>
						<input type="file" name="upload_file[]" multiple id="upload_file">
					</div>
				</div>

					<!-- <div class="hoge"></div> -->
					<!-- <img src="data file" alt="" width="300" height="200"> -->
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3">説明</span>
									<textarea class="form-control"  name="Exposition" maxlength="20"  placeholder="アメニティの貸出サービス・片付け"></textarea>
						</div>
					</div>

					<div id="select" class="form-button_group">
						<label for="amenity">アメニティ</label><br>
							<label><input type="checkbox" class="infras" name="Network" value="Wi-Fi"/>Wi-Fi</label>
							<label><input type="checkbox" class="infras" name="Electrical" value="電気"/>電気</label>
							<label><input type="checkbox" class="infras" name="Water" value="水道"/>水道</label><br>
							<label><input type="checkbox" class="infras" name="Parking" value="駐車場"/>駐車場</label>
							<label><input type="checkbox" class="infras" name="Toilet" value="トイレ"/>トイレ</label>
							<label><input type="checkbox" class="infras" name="Gas" value="ガス"/>ガス</label><br>
							<label><input type="checkbox" class="infras" name="Barrierfree" value="バリアフリー"/>バリアフリー</label>
							<label><input type="checkbox" class="infras" name="FoodDrink" value="飲食"/>飲食</label>
							<label><input type="checkbox" class="infras" name="AirCondition" value="冷暖房使用可能"/>冷暖房使用可能</label>
							<!-- <label><input type="checkbox" name="ame_smoke" value="喫煙可能"/>喫煙可能</label> -->
							<label><input type="checkbox" name="NoFire" value="火気厳禁"/>火気厳禁</label>
					</div>


					<div id="select" class="form-button_group">
						<label for="id">カテゴリー</label><br>

							<label><input type="checkbox" class="categorys" name="kategory[0]" value="パーティー"/>パーティー</label>
							<label><input type="checkbox" class="categorys" name="kategory[1]" value="演奏"/>演奏</label>
							<label><input type="checkbox" class="categorys" name="kategory[2]" value="会議"/>会議</label><br>
							<label><input type="checkbox" class="categorys" name="kategory[3]" value="スポーツ"/>スポーツ</label>
							<label><input type="checkbox" class="categorys" name="kategory[5]" value="オフィス"/>オフィス</label>
							<label><input type="checkbox" class="categorys" name="kategory[4]" value="結婚式"/>結婚式</label><br>
							<label><input type="checkbox" class="categorys" name="kategory[6]" value="車・バイク練習"/>車・バイク練習</label>
							<label><input type="checkbox" class="categorys" name="kategory[7]" value="料理"/>料理</label>
							<label><input type="checkbox" class="categorys" name="kategory[8]" value="展示"/>展示会</label>
							<label><input type="checkbox" class="categorys" name="kategory[9]" value="写真撮影"/>写真撮影</label><br>
							<label><input type="checkbox" class="categorys" name="kategory[10]" value="その他"/>その他</label>
						</div>
					<div id="" class="form-group ninzu">
						<div style="width:200px;" class="input-group">
								<span class="input-group-addon" id="basic-addon4">人数</span>
							<input id="people" type="text" class="form-control" name="PeopleNum" pattern="^([0-9]{0,8})$"required maxlength="8" value="">
								<span class="input-group-addon" id="basic-addon2">人</span>
						</div>
					</div>

										<div id="" class="form-group hirosa">
											<div style="width:200px;" class="input-group">
													<span class="input-group-addon" id="basic-addon4">広さ</span>
												<input id="fac_area" type="text" class="form-control" name="Area" pattern="^-?\d{1,}\.\d*$"required value=""maxlength="6" placeholder="00.00">
													<span class="input-group-addon" id="basic-addon2">m&#178;</span>
											</div>
										</div>

						<div id="test" style="width:200px;" class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon4">料金</span>
							<input id="price" type="text" class="form-control" name="Price" pattern="^([0-9]{0,7})$"maxlength="7" required value="">
								<span class="input-group-addon" id="basic-addon2">円</span>
						</div>
					</div>

					<div id="check" class="form-button_group">
						<label  class="">支払い方法</label>
							<label><input type="checkbox" class="pays" name="pay_cash"  value="現金"/>現金</label>
							<label><input type="checkbox" class="pays" name="pay_card"  value="カード"/>カード</label>
							<label><input type="checkbox" class="pays" name="pay_cry"   value="暗号通貨" disabled>暗号通貨</label>
					</div>

					<div class= "button_group">
						<div class="col-md-8 col-md-offset-4 col-xs-offset-4">
							<input type="hidden" id="facilityIdent">
							<input type="hidden" id="userid">
							<button type="button" class="btn btn-primary cancel" onClick="location.href='mypage.php'">キャンセル</button>
							<button type="submit" class="btn btn-primary ok">確認する</button>
						</div>
					</div>
				</form>
			</div>
		</div>


<script type="text/javascript" src="/php/js/gazou1.js"></script>
<script type="text/javascript" src="/php/js/getPostEdit.js"></script>
</body>
</html>
