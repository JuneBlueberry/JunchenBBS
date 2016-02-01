<!DOCTYPE html>
<html>
<head>
	<title>错误信息</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<?php
		require_once './conn/conn.php';
	?>
</head>
<body onload="init()">
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
	<!-- 错误信息 -->
	<div class="t" align="center">
		<br/>
		<font color="red">
			<?php echo $_REQUEST["msg"]; ?>
		</font>
		<br/>
		<br/>
		<input type="button" value="返回" onclick="window.history.back();" class="btn"></input>
		<br/>
		<br/>
	</div>
	<br/>
	<center class="gray">2016 Junchen论坛 版权所有</center>
</body>
</html>