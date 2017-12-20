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
		require('navbar1.php');
	?>

	<div class="container">
		<div class="text-center"><h3>投稿画面</h3></div>
		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" role="form" method="get" action="#" enctype="multipart/form-data"method="POST">
<div class="form-group">
							<label for="id" class="col-md-4 control-label">施設名</label>
							<div class="col-md-6">
								<input id="id" type="text" class="form-control" name="name" required autofocus　value="" placeholder="施設名登録">
							</div>
						</div>

<div class="form-group">
							<label for="id" class="col-md-4 control-label">〒</label>
							<div class="col-md-6">
								<input id="id" type="text" class="form-control" name="" required autofocus　value="" placeholder="郵便番号">
							</div>
						</div>
<div class="form-group">
              <label for="id" class="col-md-4 control-label">住所</label>
              <div class="col-md-6">
                <input id="id" type="text" class="form-control" name="" required autofocus　value="" placeholder="施設の住所">
              </div>
      			</div>

<div class="form-group">
              <label for="id" class="col-md-4 control-label">メールアドレス</label>
            	<div class="col-md-6">
            	<input id="id" type="text" class="form-control" name="e-mail" required autofocus　value="" placeholder="メール">
            	</div>
            </div>
<div class="form-group">
              <label for="id" class="col-md-4 control-label">電話番号</label>
            	<div class="col-md-6">
            	<input id="id" type="text" class="form-control" name="tell" required autofocus　value="" placeholder="電話">
            	</div>
            </div>

              <div class="form-group">
              							<label for="id" class="col-md-4 control-label">人数</label>
              							<div class="col-md-2">
              							<input id="id" type="text" class="form-control" name="人数" required autofocus　value="" placeholder=""><label>人</label>
              						</div>
              </div>




<div class="form-group">
        <label for="id" class="col-md-4 control-label">日程</label>
        <input type="text" id="datepickerFrom" placeholder="クリックして下さい"/>

        <label >～</label>
        <input type="text" id="datepickerTo" placeholder="クリックして下さい"/>
</div>
<div class="form-group">

					<label for="kanso" class="col-md-4 control-label">注意事項</label>
					<div class="col-md-6" >
					<textarea id="kanso"  name="kanso" cols="48" rows="3" maxlength="20"  placeholder="注意事項を記入"></textarea>
				</div>
</div>
<div class="form-group">
					<label for="id" class="col-md-4 control-label">画像添付</label>
						<input type="file" name="upload_file[]" multiple id="upload_file" class="data file">

</div>
						<!-- <img src="data file" alt="" width="300" height="200"> -->



<div id="" class="form-button_group">
					<label for="id" class="col-md-4 control-label">アメニティ</label>
<div style="overflow:hidden">
	<div style="float:left;">
		<div style="width:400px;float:left;border-width;">
					<label><input type="checkbox" name="ame"value=""/>Wi-Fi</label>
					<label><input type="checkbox" name="ame"value=""/>電気</label>
					<label><input type="checkbox" name="ame"value=""/>水道</label><br>
					<label><input type="checkbox" name="ame"value=""/>駐車場</label>
					<label><input type="checkbox" name="ame"value=""/>トイレ</label>
					<label><input type="checkbox" name="ame"value=""/>ガス</label><br>
					<label><input type="checkbox" name="ame"value=""/>バリアフリー</label>
					<label><input type="checkbox" name="ame"value=""/>飲食</label>
					<label><input type="checkbox" name="ame"value=""/>冷暖房使用可能</label>
					<label><input type="checkbox" name="ame"value=""/>喫煙可能</label>
					<label><input type="checkbox" name="ame"value=""/>火気使用可能</label>
</div>
</div>
</div>
</div>
<div class="form-group">
        <label for="kanso" class="col-md-4 control-label">簡易説明</label>
        <div class="col-md-6" >
        <textarea id="kanso"  name="kanso" cols="48" rows="3" maxlength="20"  placeholder="アメニティの貸出サービス・片付け"></textarea>
      </div>
</div>

<div class="form-group">
							<label for="id" class="col-md-4 control-label">値段</label>
							<div class="col-md-2">
							<input id="id" type="text" class="form-control" name="" required autofocus　value="" placeholder=""><label>円</label>
						</div>
</div>
<div id="" class="form-button_group">
					<label for="id" class="col-md-4 control-label">支払い方法</label>
<div style="overflow:hidden">
	<div style="float:left;">
		<div style="width:400px;float:left;border-width;">
					<label><input type="checkbox" name="pay"value=""/>現金</label>
					<label><input type="checkbox" name="pay"value=""/>カード</label>
					<label><input type="checkbox" name="pay"value=""disabled>暗号通貨</label>

				</div>
				</div>
				</div>
				</div>

<div class="col-md-10 col-md-offset-1 button_group">
						<div class="col-md-6 col-md-offset-4">
							<input type="hidden" id="facilityIdent">
							<input type="hidden" id="userid">
							<button class="btn btn-primary cancel">キャンセル</button>
							<button type="submit" class="btn btn-primary ok">投稿する</button>
				</div>
			</div>
		</div>
</div>

</form>
<script type="text/javascript" src="/php/js/gazou.js"></script>
</body>
</html>
