<?php
	/*处理登录操作*/
	header('Content-Type:text/html;charset=utf-8');

	require_once '../conn/user.dao.php';

	$msg = "";
	if(isset($_POST["uName"])){		//用户名不能为空
		$curUser = findUser($_POST["uName"]);		//根据用户名查询用户信息
		if(isset($curUser) && $curUser["uPass"]==$_POST["uPass"]){		//判断用户名与密码是否正确
			$_SESSION["current_user"] = $curUser;		//将用户信息保存到会话中
			header("location: ../index.php");		//成功登陆到首页
			return ;
		} else {
			$msg = "用户名或密码错误";
		}
	} else {
		$msg = "用户名不能为空";
	}
	header("location: ../error.php?msg=$msg");
?>