<!DOCTYPE html>
<html>
<head>
	<title>君尘管理论坛--错误页面</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<?php
		require_once './conn/conn.php';
	?>
</head>
<body onload="init()">
	<div>
		<?php
			echo do_html_head();
		?>
	</div>
	<!-- 错误信息 -->
	<div class="t" align="center">
		<br/>
		<font color="red">
			<?php echo $_REQUEST["msg"]; ?>
		</font>
		<br/>
		<br/>
		<input type="button" value="返回" onclick="window.history.back();" class="btn"></input>
		<br/>
		<br/>
	</div>
	<br/>
	<?php
		echo do_html_footer();
	?>
</body>
</html>