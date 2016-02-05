<?php
	header('Content-Type:text/html;charset=utf-8');

	require_once '../conn/reply.dao.php';

	$msg = "";

	if(isset($_SESSION["current_user"])){
		$replyId = $_POST["replyId"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$boardId = $_POST["boardId"];
		$currentPage = $_POST["currentPage"];
		$currentReplyPage = $_POST["currentReplyPage"];
		$topicId = $_POST["topicId"];

		$rs = updateReply($replyId,$title,$content);
		if(!$rs){
			$msg = "回帖信息修改错误";
		}
	} else {
		$msg = "用户未登录，请登录后再来回帖!";
	} 
	if($msg=""){
		die(header("location: ../error.php?msg=$msg"));
	} else {
		header("location: ../detail.php?boardId=$boardId&currentPage=$currentPage&currentReplyPage=$currentReplyPage&topicId=$topicId");
	}
	
?>