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
<<<<<<< HEAD
		$currentPage = empty($_GET["currentPage"])?0:$_GET["currentPage"];		//当前页码
=======
<<<<<<< HEAD
		$currentPage = empty($_GET["currentPage"])?0:$_GET["currentPage"];		//当前页码
=======
		$currentPage = empty($_GET["currentPage"])?"":$_GET["currentPage"];		//当前页码
>>>>>>> origin/master
>>>>>>> origin/master
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
<<<<<<< HEAD
			<!-- <?php
=======
<<<<<<< HEAD
			<!-- <?php
=======
			<?php
>>>>>>> origin/master
>>>>>>> origin/master
				$tmp = "发表新帖";
				if($topicId != ""){		//判断是否为回帖
					$topic = findTopicById($topicId);
					$tmp = $topic["title"];
					$tmp = "回复:".$tmp;
				}

				$html_str = <<<HTML_STR
<<<<<<< HEAD
			<form name="postForm" onsubmit="return valid()" action="manage/doPost.php" methor="POST">
=======
<<<<<<< HEAD
			<form name="postForm" onsubmit="return valid()" action="manage/doPost.php" methor="POST">
=======
			<form name="postForm" onsubmit="return valid()" action="manage/doPost.php" methor="post">
>>>>>>> origin/master
>>>>>>> origin/master
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> origin/master
			?> -->
			               <?php
               $tmp = "发表新帖";
                if($topicId !=""){//是否为回帖
                    $topic = findTopicById($topicId); 
                    $tmp = $topic["title"];
                    $tmp = "回复:".$tmp;
                }
                $html_str = <<<HTML_STR
                <FORM name="postForm" onsubmit="return valid()"  action="manage/doPost.php" method="POST">
                    <INPUT type="hidden" name="boardId" value="$boardId" />
                    <INPUT type="hidden" name="topicId" value="$topicId" />
                    <INPUT type="hidden" name="currentPage" value="$currentPage" />
                    <DIV class="t">
                        <TABLE cellSpacing="0" cellPadding="0" align="center">
                            <TR>
                                <TD width="10%" class="h" colSpan="3">
                                    <B> $tmp </B>
                                </TD>
                            </TR>
                            <TR class="tr3">
                                <TH width="10%">
                                    <B>标题</B>
                                </TH>
                                <TH>
                                    <INPUT class="input"
                                           style="PADDING-LEFT: 2px; FONT: 14px Tahoma" tabIndex="1"
                                           size="60" name="title">
                                </TH>
                            </TR>
                            <TR class="tr3">
                                <TH vAlign=top>
                                    <DIV>
                                        <B>内容</B>
                                    </DIV>
                                </TH>
                                <TH colSpan=2>
                                    <DIV>
                                        <span><textarea id="content" name="content" style="width:500px;height:400px;visibility:hidden;"></textarea> </span>
                                    </DIV>
				(不能大于:<FONT color="blue">1000</FONT>字)
                                </TH>
                            </TR>
                        </TABLE>
                    </DIV>
                    <DIV style="MARGIN: 15px 0px; TEXT-ALIGN: center">
                        <INPUT class="btn" tabIndex="3" type="submit" value="提 交">
                        <INPUT class="btn" tabIndex="4" type="reset" value="重 置">
                    </DIV>
                </FORM>
HTML_STR;
                echo $html_str;
              ?>
<<<<<<< HEAD
=======
=======
			?>
			
>>>>>>> origin/master
>>>>>>> origin/master
		</div>
	</div>
	<br/>
	<?php echo do_html_footer(); ?>
</body>
</html>