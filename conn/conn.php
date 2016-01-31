<?php
	header('Content-Type:text/html;charset=utf-8');

	require_once 'config.php';	//引入配置文件

	/*公共方法集，访问数据库*/
	function get_Connect(){
		$connection = mysql_connect($GLOBALS["cfg"]["server"]["adds"],$GLOBALS["cfg"]["server"]["db_user"],$GLOBALS["cfg"]["server"]["db_psw"]) or die(header("location:./error.php?msg=数据库服务器参数错误"));
		$db = @mysql_select_db($GLOBALS["cfg"]["server"]["db_name"],$connection) or die(header("location:./error.php?msg=数据库名错误"));
		mysql_query("set names utf8");
		return $connection;
	}

	/*执行查询操作*/
	function execQuery($strQuery){
		$results = array();
		$connection = get_Connect();
		$rs = @mysql_query($strQuery,$connection) or die(header("location:./error.php?msg=查询失败"));
		for($i=0; $i<mysql_num_rows($rs); $i++){
			$results[$i] = mysql_fetch_assoc($rs);
		}
		mysql_free_result($rs);
		mysql_close();
		return $results;
	}

	/*执行修改，删除，插入操作*/
	function execUpdate($strUpdate){
		$connection = get_Connect();
		$rs = @mysql_query($strUpdate,$connection) or die(header("location:./error.php?msg=数据表i操作失败"));
		$result = mysql_affected_rows();		//数据影响的哪一行，返回值类型int
		mysql_close();
		return $result;
	}
?>