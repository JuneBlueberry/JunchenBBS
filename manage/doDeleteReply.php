<?php 
	/*删除回帖信息*/

	require_once '../conn/reply.dao.php';

	$msg = "";
	if(isset($_SESSION["current_user"])){	//判断当前用户是否登录
		$current_user = $_SESSION["current_user"];	//取当前用户信息
		$boardId = $_GET["boardId"];		//取版块信息
		$curPage = empty($_GET["currentPage"])?0:$_GET["currentPage"];	//当前页码
		$replyId = empty($_GET["replyId"])?0:$_GET["replyId"];	//当前的回帖编号
		$reply = findReplyById($replyId);	//查询当前回帖信息
		if($current_user["uId"] == $reply["uId"]){	//判断当前用户能否删除该回帖
			//删除回帖，并判断是否出错
			$rs = deleteReply($replyId);
			if(!$rs){
				$msg = "回帖删除错误";
			}
		} else {
			$msg = "当前用户不能删除该回帖";
		}
	} else {
		$msg = "用户未登录，请登录后再进行操作";
	}	 
	if($msg != ""){
		die(header("location: ../error.php?msg=$msg"));
	} else {
		header("location: ../list.php?boardId=$boardId&currentPage=$curPage");
	}
?>