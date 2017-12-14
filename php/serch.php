<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Serch</title>
	<link href="/php/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/php/css/serch.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
		
		if(isset($_GET["keyword"])){
			$param = $_GET["keyword"];
		}
		else{
			$param = null;
		}
	?>
	<script type="text/javascript">
		var serchparam = '<?php echo $param; ?>';
		var dataprocess = "top";
		var ident = null;
		var userid = null;
	</script>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 serchbox">
				<form class="form-horizontal" method="get" action="/php/serchcontroller">
					<div class="form-group">
						<label class="col-md-4 control-label" for="paramValue">検索</label>
						<div class="col-md-6 sercharea">
							<input type="text" class="form-control" id="paramValue" name="keyword" placeholder="キーワード検索">
							<input type="hidden" name="process" value="serch">
							<button type="submit" class="btn btn-primary">検索</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1" id="serchResult"></div>
		</div>
	</div>
	<script type="text/javascript" src="/php/js/dispFacility.js"></script>
	<script type="text/javascript" src="/php/js/getFacility.js"></script>
</body>
</html>