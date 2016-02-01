<!DOCTYPE html>
<html>
<head>
	<title>君尘管理论坛--登录</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<script language="javascript">
		function check() {
			if(document.loginForm.uName.value == ""){
				alert("用户名不能为空");
				return false;
			}
			if(document.loginForm.uPass.value == ""){
				alert("密码不能为空");
				return flase;
			}
		}
	</script>
	<?php
		require_once './conn/conn.php';
	?>
</head>
<body>
	<div>
		<?php
			echo do_html_head();
		?>
	</div>
	<br/>
	<!-- 导航 -->
	<div>
		&gt;&gt;<b><a href="index.php">论坛首页</a></b>
	</div>
	<!-- 用户登录表单 -->
	<div class="t" style="margin-top: 15px" align="center">
		<form name="loginForm" onsubmit="return check()" action="./manage/doLogin.php" method="post">
			<br/>用户名&nbsp;
			<input class="input" tabindex="1" type="text" maxlength="20" size="35" name="uName"></input>
			<br/>
			<br/>密&nbsp;码&nbsp;
			<input class="input" tabindex="2" type="password" maxlength="20" size="35" name="uPass"></input>
			<br/>
			<br/>
			<input class="btn" tabindex="3" type="submit" style="margin-bottom: 15px" value="登 录"></input>
		</form>
	</div>
	<br/>
	<?php
		echo do_html_footer();
	?>
</body>
</html>