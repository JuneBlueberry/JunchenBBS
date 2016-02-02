<!DOCTYPE html>
<html>
<head>
	<title>看帖</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<?php
		require_once 'board.dao.php';
		require_once 'topic.dao.php';
		require_once 'reply.dao.php';
	?>
</head>
<body>
	<div>
		<?php
			do_html_head();
		?>
	</div>
	<br/>
	<?php
		do_html_footer();
	?>
</body>
</html>