<!DOCTYPE html>
<html>
<head>
	<title>看帖</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<?php
		require_once 'conn/board.dao.php';
		require_once 'conn/topic.dao.php';
		require_once 'conn/reply.dao.php';
		error_reporting(0);
	?>
	<script type="text/javascript" language="javascript">
		function deleteReply(title,replyId,boardId,currentPage){
			if(window.confirm("您确定要删除标题为:"+title+",的帖子吗?")){
				var url = "manage/doDeleteReply.php?replyId="+replyId+"&boardId="+boardId+"&currentPage="+currentPage;
				window.location = url;
			}
		}
	</script>
</head>
<body>
	<div>
		<?php
			echo do_html_head();
		?>
	</div>
	<br/>
	<!-- 主体 -->
	<div>
		<?php
			$boardId = $_GET["boardId"];
			$topicId = $_GET["topicId"];
			$curPage = $_GET["currentPage"];
			$curReplyPage = $_GET["currentReplyPage"];

			$boardName = "";		//版块名称
			$curBoard = array();	//当前版块信息
			$curTopic = array();	//帖子信息
			$msg = "";				//出错信息
			if(isset($boardId)){	//判断版块是否存在
				$curBoard = findBoard($boardId);
				$curTopic = findTopicById($topicId);
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

			$replies = findListReply($curReplyPage+1,$topicId);		//取该页的回帖信息
			$replyNum = findCountReply($topicId);			//统计当前帖子的回帖数量
			$pageSize = $GLOBALS["cfg"]["server"]["page_size"];		//页面容量
			//计算总页数
			if( $replyNum%$pageSize == 0 ){
				$pages = $replyNum/$pageSize;
			} else {
				$pages = (int)($replyNum/$pageSize) + 1;
			}
			//print_r($curTopic);
			//print_r($replies);
			//echo $replyNum;
			//ehco $pages;
			//$page = $replyNum%$pageSize==0?$replyNum/$pageSize:(int)($replyNum/$pageSize) + 1;
			$explor = <<<HTML_STR
				&gt;&gt;<b><a href="index.php">论坛首页</a></b>
				&gt;&gt;<b><a href="list.php?boardId=$boardId & currentPage=0">$boardName</a></b>
HTML_STR;
			echo $explor;
		?>
	</div>
	<br/>
	<div>
		<!-- 新帖版块 -->
		<a href='post.php?<?php echo "boardId=$boardId & topicId=$topicId & currentPage=$curPage" ?>'>
			<img src="image/reply.gif" name="td_reply" border="0" id="td_reply">
		</a>
		<a href='post.php?<?php echo "boardId=$boardId" ?>'>
			<img src="image/post.gif" name="td_post" border="0" id="td_post">
		</a>
	</div>
	<br/>
	<!-- 翻页 -->
	<div>
		<?php
			$html_page = "";
			if($curReplyPage < 1){	//判断是否为第一页
				$html_page = "上一页|";
			} else {			//不为第一页
				$curReplyPage --;
				$html_page .= "<a href='detail.php?boardId=$boardId&currentPage=$curPage&currentReplyPage=$curReplyPage&topicId=$topicId'>上一页</a>|";
				$curReplyPage ++;
			}
			if( ($curReplyPage+1)>= $pages){		//判断是否为最后一页
				$html_page .= "下一页";
			} else {			//不为最后一页
				$curReplyPage ++;
				$html_page .= "<a href='detail.php?boardId=$boardId&currentPage=$curPage&currentReplyPage=$curReplyPage&topicId=$topicId'>下一页</a>|";
				$curReplyPage --;
			}
			$tmp = $curReplyPage + 1;
			$html_page .= "|当前第 $tmp 页/共 $pages 页";
			echo $html_page;
		?>
	</div>
	<br/>
	<!-- 本页主题的标题 -->
	<div>
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<th class="h">本页主题:<?php echo $curTopic["title"]; ?></th>
			</tr>
			<tr class="tr2">
				<td>&nbsp;</td>
			</tr>
		</table>
	</div>
	<br/>
	<!-- 主体 -->
	<?php
		//显示帖子信息
		$html_topic = <<<HTML_TABLE
			<div class="t">
			<table style="border-top-width: 0px; table-layout: fixed" cellspacing="0" cellpadding="0" width="100%">
				<tr class="t">
					<th style="width: 20%">
						<b> $curTopic[uName] </b><br/>
						<img src="image/head/$curTopic[head]"><br/>
						注册:$curTopic[publishTime]<br/>
					</th>
					<th>
						<h4> $curTopic[title] </h4>
						<div> $curTopic[content] </div>
						<div class="tipad gray">
							发表:[ $curTopic[publishTime] ] &nbsp;
							最后发表:[ $curTopic[modifyTime] ]
						</div>
					</th>
				</tr>
			</table>
			</div>
HTML_TABLE;
		//回帖页面
	if(count($replies)>0){	//判断当前帖子是否有回帖
		$flag = false;
		$curId = "";
		if(isset($_SESSION["current_user"])){	//判断当前是否有用户登录
			$current_user = $_SESSION["current_user"];
			$curId = $current_user["uId"];
			$flag = true;
		}
		foreach ($replies as $reply) {
			$tmp = "";
			if($flag && $curId == $reply["uId"]){
				$tmp = <<<HTML_STR
					<a href="javascript:deleteReply('$reply[title]','$reply[replyId]','$boardId','$curPage')">[删除]</a>
					<a href="update.php?currentPage=$curPage&currentReplyPage=$curReplyPage&boardId=$boardId&topicId=$topicId&replyId=$reply[replyId]">[修改]</a>
HTML_STR;
			}

			$html_topic .= <<<HTML_TABLE
				<div class="t">
				<table style="border-top-width: 0px; table-layout: fixed" cellspacing="0" cellpadding="0" width="100%">
					<tr class="t">
						<th style="width: 20%">
							<b> $reply[uName] </b><br/>
							<img src="image/head/$reply[head]"><br/>
							注册:$reply[publishTime]<br/>
						</th>
						<th>
							<h4> $reply[title] </h4>
							<div> $reply[content] </div>
							<div class="tipad gray">
								发表:[ $reply[publishTime] ] &nbsp;
								最后发表:[ $reply[modifyTime] ]
								$tmp
							</div>
						</th>
					</tr>
				</table>
				</div>
HTML_TABLE;
		}
	}
		echo $html_topic;
	?>
	<br/>
	<?php
		echo do_html_footer();
	?>
</body>
</html>