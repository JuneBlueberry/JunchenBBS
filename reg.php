<!DOCTYPE html>
<html>
<head>
	<title>君尘管理论坛--注册</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<script language="javascript">
		function init() {
			document.regForm.head[0].checked=true;	//初始化头像设置	
		}
		function check(){
			if(document.regForm.uName.value == ""){
				alert("用户名不能为空");
				return false;
			}
			if(document.regForm.uPass.value == ""){
				alert("密码不能为空");
				return false;
			}
			if(document.regForm.uPass.value != document.regForm.uPass1.value){
				alert("两次输入的密码不一致");
				return false;
			}
		}
	</script>
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
		&nbsp;|&nbsp;<a href="manage/doLogin.php">登出</a> |
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
	<!-- 用户注册表单 -->
	<div class="t" style="margin-top: 15px" align="center">
		<form name="regForm" onsubmit="return check()" action="./manage/doReg.php" method="post">
			<br/>用&nbsp;户&nbsp;名&nbsp;
			<input class="input" tabindex="1" type="text" maxlength="20" size="40" name="uName"></input>
			<br/>密&nbsp;&nbsp;码&nbsp;
			<input class="input" tabindex="2" type="password" maxlength="20" size="40" name="uPass"></input>
			<br/>重复密码&nbsp;
			<input class="input" tabindex="3" type="password" maxlength="20" size="40" name="uPass1"></input>
			<br/>
			<br/>性别&nbsp;
			女<input type="radio" name="gender" value="1"></input>
			男<input type="radio" name="gender" value="2" checked="checked"></input>
			<br/>
			<br/>请选择头像<br/>
			<?php
				for($i = 1; $i<=15; $i++){
					echo "<img src='image/head/$i.gif'><input type='radio' name='head' value='$i.gif'>";
					if($i % 5 == 0){	//每5行换一行
						echo "<br/>";
					}
				}
			?>
			<br/>
			<input class="btn" tabindex="4" type="submit" value="注册"></input>
		</form>
	</div>
	<br/>
	<center class="gray">2016 Junchen论坛 版权所有</center>
</body>
</html>