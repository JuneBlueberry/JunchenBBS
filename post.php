<!DOCTYPE html>
<html>
<head>
	<title>发布帖子</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"></meta>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
	<script type="text/javascript">
		//初始化文件编译器
		// var = editor;
		// KindEditor.ready(function(K){
		// 	editor = K.create('textarea[name="content"]',{cssPath:'kindeditor/plugins/code/prettify.css',allowImageUpload:false,allowFlashUpload:false,allowMediaUpload:false});
		// 	prettyPrint();
		// });
		var editor;
            KindEditor.ready(function(K) {
                 editor = K.create('textarea[name="content"]', {
                    cssPath : 'kindeditor/plugins/code/prettify.css',
                    allowImageUpload:false,allowFlashUpload:false,
                    allowMediaUpload:false});
                prettyPrint();
            });
            //表单域验证
            function valid(){
            	if(document.postForm.title.value == ""){
            		alert("标题不能为空");
            		return false;
            	}
            	content = editor.html();	//获取编辑框中的值
            	if(content == ""){
            		alert("内容不能为空");
            		return false;
            	}
            	if(content.lenght>1000){
            		alert("长度不能大于1000");
            		return false;
            	}
            }

            function init(){	//初始化函数，用于判断是否重新发帖
            	if(document.postForm.topicId.value != ""){
            		document.postForm.action="manage/doReply.php";
            	}
            }
	</script>
	<?php
		require_once './conn/board.dao.php';
		require_once './conn/topic.dao.php';
		error_reporting(0);
		$boardName = "";	//版块名称
		$boardId = "";		//版块编号
		$topicId = empty($_GET["topicId"])?"":$_GET["topicId"];		//帖子编号
		$currentPage = empty($_GET["currentPage"])?"":$_GET["currentPage"];		//当前页码
		if(!empty($_GET["boardId"])){
			$boardId = $_GET["boardId"];
		} else {
			$msg = "版块编号不存在";
			die(header("location: ../error.php?msg=$msg"));
		}
		$board = findBoard($boardId);
		$boardName = $board["boardName"];
	?>
</head>
<body onload="init()">
	<div>
		<?php echo do_html_head(); ?>
	</div>
	<!-- 主体 -->
	<div>
		<br/>
		<!-- 导航 -->
		<div>
			<?php
				//设置导航语句
				$explor = <<<HTML_STR
					&gt;&gt;<b><a href="index.php">论坛首页</a></b>
					&gt;&gt;<b><a href="list.php?boardId=$boardId & currentPage=0">$boardName</a></b>
HTML_STR;
			echo $explor;
			?>
		</div>
		<br/>
		<div>
			<?php
				$tmp = "发表新帖";
				if($topicId != ""){		//判断是否为回帖
					$topic = findTopicById($topicId);
					$tmp = $topic["title"];
					$tmp = "回复:".$tmp;
				}

				$html_str = <<<HTML_STR
			<form name="postForm" onsubmit="return valid()" action="manage/doPost.php" methor="post">
				<input type="hidden" name="boardId" value="$boardId"></input>
				<input type="hidden" name="topicId" value="$topicId"></input>
				<input type="hidden" name="currentPage" value="$currentPage"></input>
				<div class="t">
					<table cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="10%" class="h" colspan="3">
								<b>$tmp</b>
							</td>
						</tr>
						<tr class="tr3">
							<th width="10%">
								<b>标题</b>
							</th>
							<th>
								<input class="input" style="padding-left: 20px; font: 14px tahoma" tabindex="1" size="60" name="title"></input>
							</th>
						</tr>
						<tr class="tr3">
							<th valign="top">
								<div>
									<b>内容</b>
								</div>
							</th>
							<th colspan="2">
								<div>
									<span>
										<textarea id="content" name="content" style="width: 600px;height: 400px;visibility: hidden;"></textarea>
									</span>
								</div>
								(不能大于:<font color="blue">1000</font>字)
							</th>
						</tr>
					</table>
				</div>
				<div style="margin: 15px 0px; text-align: center">
					<input class="btn" tabindex="3" type="submit" value="提 交"></input>
					<input class="btn" tabindex="4" type="reset" value="重 置"></input>
				</div>
			</form>
HTML_STR;
			echo $html_str;
			?>
			
		</div>
	</div>
	<br/>
	<?php echo do_html_footer(); ?>
</body>
</html>