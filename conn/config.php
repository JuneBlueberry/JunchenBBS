<?php
	header('Content-Type:text/html;charset=utf-8');

	/*数据库服务器参数配置*/
	$cfg["server"]["adds"]="localhost";
	$cfg["server"]["db_user"]="root";
	$cfg["server"]["db_psw"]="";
	$cfg["server"]["db_name"]="jcbbs";
	$cfg["server"]["page_size"]="3";

	/**
	*论坛错误处理方法
	*$errno 错误编号
	*$errstr 错误信息
	*/
	function bbsError($errno,$errstr){
		die(header("location:./error.php?msg=$errstr"));
	}
	//设置错误捕捉器
	set_error_handler("bbsError",E_ERROR);
?>