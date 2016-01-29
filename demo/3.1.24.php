<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>数据库连接</title>
</head>
<body>
	<?php 
		error_reporting(E_ALL ^ E_DEPRECATED);
		/*创建于数据库连接的函数*/
		function get_Connect(){
			//创建于数据库连接
			$connection = mysql_connect("localhost","root","","jcbbs") or die("连接创建错误!");
			//选择君尘数据库
			mysql_select_db("jcbbs",$connection) or die("无法激活君尘数据库!");
			//设置数据库编码为utf8
			mysql_query("set names utf8");
			return $connection;
		}

		if($conn = get_Connect()){
			echo "连接成功".mysql_get_host_info($conn);
		}

		/*取所有用户信息函数*/
		function getUsers(){
			$conn = get_Connect();									//创建于数据库的连接
			$query = "select * from bbs_user";						//定义查询语句
			$result = array();										//定义数组
			$rs = mysql_query($query,$conn) or die("查询错误!");	//保存查询结果
			for($i=0; $i<mysql_num_rows($rs); $i++){				//循环将查询结果保存到数组中
				$result[$i] = mysql_fetch_assoc($rs);
			}
			mysql_free_result($rs);									//释放结果集
			mysql_close($conn);										//关闭连接
			return $result;											//返回查询结果
		}
		//读取用户信息
		$result = getUsers();
	 ?>
	 <h2 align="center">用户列表</h2>
	 <table border="1" cellpadding="0" cellspacing="0" align="center">
	 	<tr height="30px">
	 		<td width="20%">序号</td>
	 		<td width="30%">姓名</td>
	 		<td width="10%">性别</td>
	 		<td width="40%">注册时间</td>
	 	</tr>
	 	<?php
	 	  $bgcolor = "#ffffff";
	 	  foreach ($result as $rec) {
	 	  	if($bgcolor == "#ffffff"){
	 	  		$bgcolor = "#dddddd";
	 	  	} else {
	 	  		$bgcolor = "#ffffff";
	 	  	}
	 	  	echo "<tr bgcolor=$bgcolor height=27>";
	 	  	echo "<td>".$rec["uId"]."</td>";
	 	  	echo "<td>".$rec["uName"]."</td>";
	 	  	echo "<td>".($rec["gender"]==2?"男":"女")."</td>";
	 	  	echo "<td>".$rec["regTime"]."</td>";
	 	  	echo "</tr>";
	 	  }
	 	?>
	 </table>
</body>
</html>