<?php
	/*注册新用户操作*/
	header('Content-Type:text/html;charset=utf-8');
	require_once '../conn/user.dao.php';	//引用用户数据表的操作方法

	$msg = "";

	if(isset($_POST["uName"])){				//如果用户名不为空，则插入数据
		$rs = addUser($_POST["uName"],$_POST["uPass"],$_POST["head"],$_POST["gender"]);
		if($rs <= 0){						//数据插入失败
			$msg = "用户注册失败";	
		} else {							//数据插入成功，转向首页面
			header("location:../index.php");
			return ;
		}
	} else {								//用户名为空
		$msg = "用户名不能为空";
	}		
	header("location:../error.php?msg=$msg");	//转向错误提示页面
?>