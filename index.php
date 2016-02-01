<!DOCTYPE html>
<html>
<head>
	<title>首页</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<?php
		require_once './conn/conn.php';
	?>
</head>
<body>
	<div>
		<?php
		$headBuf =<<<HEAD
		<div>
		<img src="./image/logo.gif">
		</div>
		<!-- 用户信息，登录，注册 -->
		<div class="h">
HEAD;
			if(isset($_SESSION["current_user"])){
				$current_user = $_SESSION["current_user"];
				$user_name = $current_user["uName"];
				$headBuf .= <<<HTML_HEAD
		您好:<a href="userdetail.php">$user_name</a>
		&nbsp;|&nbsp;<a href="manage/doLogout.php">登出</a> |
HTML_HEAD;
			} else {
				$headBuf .= <<<HTML_HEAD
		您尚未  <a href="login.php">登录</a>
		&nbsp;| &nbsp; <a href="reg.php">注册</a> |
HTML_HEAD;
			}
				$headBuf .= "</div>";	
				echo $headBuf;
		?>
	</div>
</body>
</html>