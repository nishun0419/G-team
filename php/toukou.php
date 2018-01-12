<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset="UTF-8" content="">
<meta name="viewport">
<title> 投稿画面</title>
<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
<link rel="stylesheet" type="text/css" href="/php/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/php/css/toukou.css">
<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/php/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/php/js/dispCalendar.js"></script>
</head>
<body>
<?php
	require('navbar.php');
?>

	<div class="container">
		<div class="text-center"><h3>投稿画面</h3></div>
			<div class="col-md-8 col-md-offset-2">
				<form class="form-horizontal" role="form" method="POST" action="../server/toukouserver.php" enctype="multipart/form-data">

					<div class="form-group">
						<label for="id" class="col-md-4 control-label">施設名</label>
						<div class="col-md-6">
							<input id="fac_name" type="text" class="form-control" name="fac_name" required autofocus　value="" placeholder="施設名登録">
						</div>
					</div>

					<div class="form-group">
						<label for="id" class="col-md-4 control-label">〒</label>
						<div class="col-md-6">
							<input id="fac_zip" type="text" class="form-control" name="fac_zip" required value="" placeholder="郵便番号">
						</div>
					</div>

					<div class="form-group">
              			<label for="id" class="col-md-4 control-label">住所</label>
            			<div class="col-md-6">
                			<input id="fac_address" type="text" class="form-control" name="fac_address" required　value="" placeholder="施設の住所">
            			</div>
      				</div>

					<div class="form-group">
            			<label for="id" class="col-md-4 control-label">メールアドレス</label>
            			<div class="col-md-6">
            				<input id="fac_email" type="text" class="form-control" name="fac_email" required value="" placeholder="メール">
            			</div>
            		</div>

					<div class="form-group">
            			<label for="id" class="col-md-4 control-label">電話番号</label>
            			<div class="col-md-6">
            				<input id="fac_tel" type="text" class="form-control" name="fac_tel" required 　value="" placeholder="電話">
            			</div>
            		</div>

					<div id="" class="form-group">
						<label for="id" class="col-md-4 control-label">人数</label>
						<div class="input-group col-md-2">
							<input id="people" type="text" class="form-control" name="people" required value="">
							<span class="input-group-addon" id="basic-addon2">人</span>
						</div>
					</div>

					<div class="form-group">
        				<label for="id" class="col-md-4 control-label">日程</label>
        				<input type="text" id="datepickerFrom" name="date_from" placeholder="クリックして下さい"/>
						<label >～</label>
						<input type="text" id="datepickerTo" name="date_to" placeholder="クリックして下さい"/>
					</div>

					<div class="form-group">
						<label for="upload_file" class="col-md-4 control-label">画像添付</label>
						<input type="file" name="upload_file[]" multiple id="upload_file" class="data file">
					</div>
					<!-- <img src="data file" alt="" width="300" height="200"> -->

					<div id="" class="form-group">
						<label for="id" class="col-md-4 control-label">広さ</label>
						<div class="input-group col-md-2">
							<input id="fac_area" type="text" class="form-control" name="fac_area" required value="" placeholder="土地広さ">
							<span class="input-group-addon" id="basic-addon2">m&#178;</span>
						</div>
					</div>

					<div id="" class="form-button_group">
						<label for="amenity" class="col-md-4 control-label">アメニティ</label>
						<div style="overflow:hidden;float:left;width:400px;float:left;border-width;">
							<label><input type="hidden" name="ame_net" value="0"/><input type="checkbox" name="ame_net" value="1"/>Wi-Fi</label>
							<label><input type="hidden" name="ame_elect" value="0"/><input type="checkbox" name="ame_elect" value="1"/>電気</label>
							<label><input type="hidden" name="ame_water" value="0"/><input type="checkbox" name="ame_water" value="1"/>水道</label><br>
							<label><input type="hidden" name="ame_parking" value="0"/><input type="checkbox" name="ame_parking" value="1"/>駐車場</label>
							<label><input type="hidden" name="ame_toilet" value="0"/><input type="checkbox" name="ame_toilet" value="1"/>トイレ</label>
							<label><input type="hidden" name="ame_gas" value="0"/><input type="checkbox" name="ame_gas" value="1"/>ガス</label><br>
							<label><input type="hidden" name="ame_barrierfree" value="0"/><input type="checkbox" name="ame_barrierfree" value="1"/>バリアフリー</label>
							<label><input type="hidden" name="ame_food" value="0"/><input type="checkbox" name="ame_food" value="1"/>飲食</label><br>
							<label><input type="hidden" name="ame_aircon" value="0"/><input type="checkbox" name="ame_aircon" value="1"/>冷暖房使用可能</label>
							<label><input type="hidden" name="ame_fire" value="0"/><input type="checkbox" name="ame_fire" value="1"/>火気使用可能</label>
						</div>
					</div>

					<div class="form-group">
        				<label for="kanso" class="col-md-4 control-label">簡易説明</label>
        				<div class="col-md-6" >
        					<textarea id="fac_text"  name="fac_text" cols="48" rows="3" maxlength="20"  placeholder="アメニティの貸出サービス・片付け"></textarea>
    					</div>
					</div>

					<div id="" class="form-button_group">
						<label for="id" class="col-md-4 control-label">カテゴリー</label>
						<div style="overflow:hidden;float:left;width:400px;float:left;border-width;">
							<label><input type="checkbox" name="cate[]" value="1"/>パーティー</label>
							<label><input type="checkbox" name="cate[]" value="2"/>演奏</label>
							<label><input type="checkbox" name="cate[]" value="3"/>会議</label><br>
							<label><input type="checkbox" name="cate[]" value="4"/>スポーツ</label>
							<label><input type="checkbox" name="cate[]" value="5"/>オフィス</label>
							<label><input type="checkbox" name="cate[]" value="6"/>結婚式</label><br>
							<label><input type="checkbox" name="cate[]" value="7"/>車・バイク練習</label>
							<label><input type="checkbox" name="cate[]" value="8"/>料理</label>
							<label><input type="checkbox" name="cate[]" value="9"/>展示会</label>
							<label><input type="checkbox" name="cate[]" value="10"/>写真撮影</label><br>
							<label><input type="checkbox" name="cate[]" value="11"/>その他</label>
						</div>
					</div>

					<div id="" class="form-group">
						<label for="id" class="col-md-4 control-label">料金</label>
						<div class="input-group col-md-2">
							<input id="price" type="text" class="form-control" name="price" required value="">
							<span class="input-group-addon" id="basic-addon2">円</span>
						</div>
					</div>

					<div id="" class="form-button_group">
						<label for="id" class="col-md-4 control-label">支払い方法</label>
						<div style="overflow:hidden;float:left;width:400px;float:left;border-width;">
							<label><input type="hidden" name="pay_cash" value="0"/><input type="checkbox" name="pay_cash" value="1"/>現金</label>
							<label><input type="hidden" name="pay_card" value="0"/><input type="checkbox" name="pay_card" value="1"/>カード</label>
							<label><input type="hidden" name="pay_cry" value="0"><input type="checkbox" name="pay_cry" value="1" disabled>暗号通貨</label>
						</div>
					</div>

					<div class="col-md-10 col-md-offset-1 button_group">
						<div class="col-md-6 col-md-offset-4">
							<input type="hidden" id="facilityIdent">
							<input type="hidden" id="userid">
							<button class="btn btn-primary cancel">キャンセル</button>
							<button type="submit" class="btn btn-primary ok">投稿する</button>
					</div>

				</form>
			</div>
		</div>
	</div>

<script type="text/javascript" src="/php/js/gazou.js"></script>
</body>
</html>
