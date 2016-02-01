<?php
	/*登出功能*/
	require_once '../conn/conn.php';

	session_destroy();
	header("location: ../index.php");
?>