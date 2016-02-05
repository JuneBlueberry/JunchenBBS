<?php
	/* 处理回帖 */

	header('Content-Type:text/html;charset=utf-8');
	require_once '../conn/reply.dao.php';

	$msg = "";
	if(isset($_SESSION["current_user"])){
		$current_user = $_SESSION["current_user"];
		$uId = $current_user["uId"];
		$boardId = $_POST["boardId"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$topicId = $_POST["topicId"];
		$currentPage = $_POST["currentPage"];
		//添加帖子回复
		$rs = addReply($title,$content,$uId,$topicId);
	} else {
		$msg = "用户未登录，请登录后再来回帖子!";
	}
	if($msg != ""){
		die(header("location: ../error.php?msg=$msg"));
	} else {
		header("location: ../detail.php?boardId=$boardId&currentPage=$currentPage&currentReplyPage=0&topicId=$topicId");
	}
?>