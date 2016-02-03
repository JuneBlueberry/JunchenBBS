<!DOCTYPE html>
<html>
<head>
	<title>帖子列表</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<?php
		require_once './conn/board.dao.php';
		require_once './conn/topic.dao.php';
		require_once './conn/reply.dao.php';
		error_reporting(0);
	?>
</head>
<body>
	<?php
		echo do_html_head();
	?>
	<div>
		<!-- 导航 -->
		<br/>
		<div>
		<br/>
			<?php
				$boardId = $_GET["boardId"];
				//echo $boardId;
				$curPage = $_GET["currentPage"];
				$boardName = "";		//版块名称
				$curBoard = array();	//当前版块信息
				$msg = "";				//出错信息
				if(isset($boardId)){	//判断版块是否存在
					$curBoard = findBoard($boardId);
					if(count($curBoard) >= 0){
						$boardName = $curBoard["boardName"];
					} else {
						$msg = "版块不存在";
					}
				} else {
					$msg = "版块编号不存在";
				}
				if($msg != ""){
					header("location: ../error.php?msg=$msg");	//转入出错页面
				}

				// 分页所需变量
				$topicList = findListTopic($curPage+1, $boardId);	//分页取指定版块帖子列表
				$topicNums = findCountTopic($boardId);		//统计版块帖子数
				$pageSize = $GLOBALS["cfg"]["server"]["page_size"];		//页面容量
				//print_r($topicList);
				//echo $topicNums;
				//echo $pageSize;
				//计算总页数
				if($topicNums%$pageSize == 0){
					$pages = $topicNums/$pageSize;
				} else {
					$pages = (int)($topicNums/$pageSize) + 1;
				}
				//$pages = $topicNums % $pageSize == 0 ? $topicNums/$pageSize : (int)($topicNums/$pageSize)+1;
				//echo $pages;
				//生成页面导航代码
				$explor = <<<HTML_STR
					&gt;&gt;<b><a href="index.php">论坛首页</a></b>
					&gt;&gt;<b><a href="list.php?boardId=$boardId & currentPage=0">$boardName</a></b>
HTML_STR;
			echo $explor;
			?>
		</div>
		<br/>
		<!-- 发新帖链接 -->
		<div>
			<a href="post.php?boardId=<?php echo $boardId ?>"><img src="image/post.gif" name="td_post" border="0" id="td_post"></a>
		</div>
		<br/>
		<!-- 分页处理 -->
			<?php
				$html_page = "";
				if($curPage < 1){	//判断是否为第一页
					$html_page = "上一页|";
				} else {			//不为第一页
					$curPage --;
					$html_page .= "<a href='list.php?boardId=$boardId & currentPage=$curPage'>上一页</a>|";
					$curPage ++;
				}
				if( ($curPage+1)>= $pages){		//判断是否为最后一页
					$html_page .= "下一页";
				} else {			//不为最后一页
					$curPage ++;
					$html_page .= "<a href='list.php?boardId=$boardId & currentPage=$curPage'>下一页</a>|";
					$curPage --;
				}
				$tmp = $curPage + 1;
				$html_page .= "|当前第 $tmp 页/共 $pages 页";
				echo $html_page;
			?>
	</div>
	<br/>
	<div class="t">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<th class="h" style="width: 100%" colspan="4">
					<span>&nbsp;</span>
				</th>
			</tr>
			<tr class="tr2">
				<td>&nbsp;</td>
				<td width="80%" align="center">文章</td>
				<td width="10%" align="center">作者</td>
				<td width="10%" align="center">回复</td>
			</tr>
			<!-- 主题列表 -->
			<?php
				$html_topic = "";
				foreach ($topicList as $topic) {
					$title = $topic["title"];
					$uName = $topic["uName"];
					$topicId = $topic["topicId"];
					$replyCount = findCountReply($topicId);
					//帖子列表HTML字符串
					$html_topic .= <<<HTML_TABLE
						<tr class="tr3">
							<td>
								<img src="image/topic.gif" border=0>
							</td>
							<td style="fonz-size: 15px">
								<a href="detail.php?boardId=$boardId & currentPage=$curPage &currentReplyPage=0 & topicId = $topicId">$title</a>
							</td>
							<td align="center">$uName</td>
							<td align="center">$replyCount</td>
						</tr>
HTML_TABLE;
				}
				echo $html_topic;
			?>
		</table>
	</div>
	<?php
		echo do_html_footer();
	?>
</body>
</html>