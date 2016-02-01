<!DOCTYPE html>
<html>
<head>
	<title>君尘管理论坛--用户信息编辑</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<script language="javascript">
		function check(){
			if(document.userForm.uName.value == ""){
				alter("用户名不能为空");
				return false;
			}
			if(document.userForm.uPass.value != document.userForm.uPass1.value){
				alter("两次输入的密码不一致");
				return false;
			}
		}
	</script>
	<?php
		require_once './conn/conn.php';
		require_once './conn/user.dao.php';
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
	<!-- 用户信息显示与修改表单 -->
	<div class="t" style="margin-top: 15px" align="center">
		<?php
			if(isset($_SESSION["current_user"])){
				$current_user = $_SESSION["current_user"];
				$uId = $current_user["uId"];		//用uId来查询，是为了防止出现重名的现象
				$user = findUserById($uId);
				$formBuf = <<<HTML_FORM
					<form name="userForm" onSubmit="return check()" action="./manage/doUserUpdate.php" enctype="multipart/form-data" method="post">
						<input name="uId" type="hidden" value="$user[uId]" />
						<br/>用&nbsp;户&nbsp;名&nbsp;
						<input class="input" tabindex="1" type="text" maxlength="20" size="40" name="uName" value="$user[uName]"></input>
						<br/>新&nbsp;密&nbsp;码&nbsp;
						<input class="input" tabindex="2" type="password" maxlength="20" size="40" name="uPass"></input>
						<br/>重复密码&nbsp;
						<input class="input" tabindex="3" type="password" maxlength="20" size="40" name="uPass1"></input>
						<br/>
HTML_FORM;
                if($user["gender"]==1){
                    $formBuf.=<<<HTML_FORM
                        <br/>性别 &nbsp;
						女<input type="radio" name="gender" value="1" checked="checked"/>
						男<input type="radio" name="gender" value="2" />
                        </br>
HTML_FORM;
                } else {
                    $formBuf.=<<<HTML_FORM
                        <br/>性别 &nbsp;
						女<input type="radio" name="gender" value="1" />
						男<input type="radio" name="gender" value="2" checked="checked"/>
                        </br>
HTML_FORM;
                }
				$isSystem = false;
				for ($i = 1; $i <=15; $i++){
					if($user["head"] == "$i.gif"){
						$formBuf .= "<img src='image/head/$i.gif'/><input type='radio' name='head' value='$i.gif' checked='checked'/>";
						$isSystem = true;
					} else {
						$formBuf .= "<img src='image/head/$i.gif'/><input type='radio' name='head' value='$i.gif'/>";
					}
					if($i % 5 == 0){
						$formBuf .= "<br/>";
					}
				}
					if(!$isSystem){
						$formBuf .= "<img src='image/head/".$user["head"]."'><input type='radio' name='head' value='".$user["head"]."' checked='checked'/>";
					}
					$formBuf .= <<<HTML_FORM
						<br/>
						自定义头像<input type="file" name="myHead">
						<br/>
						<input class="btn" tabindex="4" type="submit" value="修改"></input>
						</form>
HTML_FORM;
			echo $formBuf;
			}	
		?>
	</div>
	<br/>
	<?php
		echo do_html_footer();
	?>
</body>
</html>