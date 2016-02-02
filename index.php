<!DOCTYPE html>
<html>
<head>
	<title>欢迎来到君尘管理论坛</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<?php
		require_once './conn/board.dao.php';
		require_once './conn/topic.dao.php';
		error_reporting(0);
	?>
</head>
<body>
	<div>
		<?php
			echo do_html_head();
		?>
	</div>
	<!-- 主体 -->
	<div class="t">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr class="tr2" align="center">
				<td colspan="2">论坛</td>
				<td style="width: 10%">主题</td>
				<td style="widows: 30%;">最后发表</td>
			</tr>
			<!-- 主版块 -->
			<?php

				//显示顶级版块
			for($i=1; $i<=2; $i++){
				$boards = findListBoard($i);
				$table_html = "";
				$parentBoard = $boards[$i]["parentBoard"];
				$table_html .= <<<HTML_TABLE
						<tr class="tr3">
							<td colspan="4">$parentBoard</td>
						</tr>
HTML_TABLE;
				//print_r($boards);
			//取二级版块
				for($j=0; $j<count($boards); $j++){
					$boardId = $boards[$j]["boardId"];
					$boardName = $boards[$j]["boardName"];
					//echo $boardId;
					$count = findCountTopic($boardId);
					$topic = findLastTopic($boardId);
					//print_r($topic);
					$user_name = $topic["uName"];
					$publishTime = $topic["publishTime"];
					$title = $topic["title"];
					$topicId = $topic["topicId"];

					//显示二级版块
					$table_html .= <<<HTML_TABLE
						<tr class="tr3">
							<td width="5%">
								&nbsp;
							</td>
							<th align="left">
								<img src="image/board.gif">
								<a href="list.php?boardId=$boardId & $currentPage=0">$boardName</a>
							</th>
							<td align="center">
								$count
							</td>
							<th>
								<span>
									<a href="detail.php?boardId=$boardId & $currentPage=0 & $currentReplyPage=0 & topicId=$topicId">$title<a/>
								</span>
								<br/>
								<span>$user_name</span>
								<span class="gray">[$publishTime]</span>
							</th>
						</tr>
HTML_TABLE;
				}

				echo $table_html;
			}	
			?>
		</table>
	</div>
	<?php
			echo do_html_footer();
	?>
</body>
</html>