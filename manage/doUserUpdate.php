<?php
	/*查看和修改用户信息*/
	require_once '../conn/user.dao.php';

	$msg = "";
	$rs = 0;

	if(isset($_POST["uId"]) && isset($_POST["uName"])){		//ID和用户名都不为空
		if($_FILES["myHead"]["error"] == 0){	//如果图片上传成功
			$myHead = $_FILES["myHead"];	//获取上传的图片
			$head = $_POST["uId"]."_".$myHead['name'];	//取出文件名
			if(($myHead["type"]=="image/gif" || $myHead["type"]=="image/jpeg" || $myHead["type"]=="image/pjpeg") && ($myHead["size"] < 50000)){			//进行文件格式和大小的过滤
				move_uploaded_file($myHead[tmp_name], "../image/head/".$head);	//上传
			} else {
				$msg = "上传文件格式应为gif或jpg，且文件大小应为小于50KB";
			}
			//上传成功时，更新数据库，设置头像为自定义头像
			$rs = updateUser($_POST['uId'],$_POST['uName'],$_POST['uPass'],$head,$_POST['gender']);
		} else {
			//已经自定义了头像，且不变时
			$rs = updateUser($_POST['uId'],$_POST['uName'],$_POST['uPass'],$_POST['head'],$_POST['gender']);
		}
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