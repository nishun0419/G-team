<?php
	require('cookieCheck.php');
	$sessionname = session_name();
	if(isset($_GET[$sessionname])){
		session_id($_GET[$sessionname]);
	}
	else{
			cookieCheck($sessionname);
		}
		// ini_set('session.use_trans_sid', '1');
		// ini_set('session.cookie_domain', 'localhost');
		// session_set_cookie_params(0, '/logincontroller');
		session_start();
?>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navmenu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/php/index.php">
				CHINook
			</a>
		</div>
		<div id=navmenu class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				&nbsp;
			</ul>

			<ul class="nav navbar-nav navbar-right">
			<?php
				if(!isset($_SESSION["UserName"])){ 
			?>
			<li><a href="/php/logincontroller" role="button">ログイン</a></li>
			<li><a href="/php/shinkicontroller" role="button">新規登録</a></li>
			<?php }else{?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><?php echo unserialize($_SESSION["UserName"])."さま"; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/php/server/logout.php">ログアウト</a></li>
						<li><a href="/php/php/mypage.php">マイページに戻る</a></li>							
						<li><a href="#">ヘルプ</a></li>
					</ul>
			</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</nav>