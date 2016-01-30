<?php
	/*用户信息数据表操作方法*/

	header('Content-Type:text/html;charset=utf-8');

	require_once "conn.php";

	function findUser($name){
		$strQuery = "select * from bbs_user where uName = '$name'"	//查询语句
		$rs = execQuery($strQuery);
		if(count($rs)>0){	//判断查询是否成功
			return $rs[0];
		}
		return $rs;
	}

	/*根据编号查询用户信息*/
	function findUserById($id){
		$strQuery = "select * from bbs_user where uId = $id";
		$rs = execQuery($strQuery);
		if(count($rs)>0){
			return $rs[0];
		}
		return $rs;
	}

	/*新增用户信息*/
	function addUser($uName,$uPass,$head,$gender="1"){
		$insertStr = "insert into bbs_user (uName,uPass,head,gender,regTime) values ";

		//设置时间格式
		$format = "%Y/%m/%d %H:%M:%S";
		$regTime = strftime($format);

		//准备插入操作参数
		$insertStr .= "('$uName','$uPass','$head',$gender,'$regTime')";	//注意是“.=”,连接语句
		$rs = execUpdate($insertStr);
		return $rs;
	}

	/*修改用户信息*/
	function updateUser($id,$uName,$uPass,$head,$gender){
		$updateStr = "update bbs_user set uName='$uName',uPass='$uPass',gender=$gender,head='$head' where uId=$id";
		$rs = execUpdate($updateStr);
		return $rs;
	}
?>