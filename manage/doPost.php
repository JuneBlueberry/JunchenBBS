	<?php
	/* 处理发帖 */
	error_reporting(0);
	header('Content-Type:text/html;charset=utf-8');
	require_once '../conn/topic.dao.php';

	$msg = "";

	if(isset($_SESSION["current_user"])){
		$current_user = $_SESSION["current_user"];
		$uId = $current_user["uId"];
		$boardId = $_POST["boardId"];
		$title = $_POST["title"];
		$content = $_POST["content"];	
		//发表帖子
		$rs = addTopic($title,$content,$uId,$boardId);
	} else {
		$msg = "用户未登录，请登录后再来发帖子!";
	}

	if($msg != ""){
		die(header("location:../error.php?msg=$msg"));
	} else {
		header("location:../list.php?boardId=$boardId&currentPage=0");
	}
?>

