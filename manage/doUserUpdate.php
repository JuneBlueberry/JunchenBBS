<?php
	/*查看和修改用户信息*/
	require_once '../conn/user.dao.php';

	$msg = "";
	if(isset($_POST["uId"]) && isset($_POST["uName"])){		//ID和用户名都不为空
		$rs = updateUser($_POST['uId'],$_POST['uName'],$_POST['uPass'],$_POST['head'],$_POST['gender']);
		if($rs <= 0){
			$msg = "用户修改失败！";
		} else {
			header("location: ./doLogout.php");
			return ;
		}
	} else {
		$msg = "用户名为空或无法获取用户编号";
	}
	header("location: ../error.php?msg=$msg");
?>