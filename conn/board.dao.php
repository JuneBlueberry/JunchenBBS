<?php
	/*版块信息表数据操作方法*/

	header('Content-Type:text/html;charset=utf-8');

	require_once "conn.php";

	/*根据版块编号查询版块信息*/
	function findBoard($boardId){
		$strQuery = "select * from bbs_board where boardId=$boardId";
		$result = array();
		$result = execQuery($strQuery);
		if(count($result)>0){
			return $result[0];
		}
		return $result;
	}

	/*根据父版块编号查询子版块信息*/
	function findListBoard($parentId){
		$strQuery = "select * from bbs_board where parentId=$parentId";
		$result = array();
		$result = execQuery($strQuery);
		return $result;
	}
?>