<!DOCTYPE html>
<html>
<head>
	<title>回复修改</title>
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
	</script>
	<?php
		require_once './conn/board.dao.php';
		require_once './conn/reply.dao.php';
		error_reporting(0);
		$boardName = "";	//版块名称
		$topicId = empty($_GET["topicId"])?"":$_GET["topicId"];		//帖子编号
		$boardId = empty($_GET["boardId"])?"":$_GET["boardId"];		//版块编号
		$currentPage = empty($_GET["currentPage"])?0:$_GET["currentPage"];		//当前页码
		$currentReplyPage = empty($_GET["currentReplyPage"])?0:$_GET["currentReplyPage"];
		if(!empty($_GET["replyId"])){
			$replyId = $_GET["replyId"];
		} else {
			$msg = "回帖编号不存在";
			die(header("location: ../error.php?msg=$msg"));
		}

		$board = findBoard($boardId);			//当前版块信息
		$boardName = $board["boardName"];		//当前版块名称
		$reply = findReplyById($replyId);		//当前回帖信息
	?>
</head>
<body>
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
					&gt;&gt;<b><a href="list.php?boardId=$boardId&currentPage=0">$boardName</a></b>
HTML_STR;
			echo $explor;
			?>
		</div>
		<br/>
		<div>
			<?php
                $html_str = <<<HTML_STR
                <FORM name="postForm" onsubmit="return valid()"  action="manage/doUpdate.php" method="POST">
                    <INPUT type="hidden" name="boardId" value="$boardId" />
                    <INPUT type="hidden" name="topicId" value="$topicId" />
                    <INPUT type="hidden" name="currentPage" value="$currentPage" />
                    <INPUT type="hidden" name="currentReplyPage" value="$currentReplyPage" />
                    <INPUT type="hidden" name="replyId" value="$replyId" />
                    <INPUT type="hidden" name="uId" value="$reply[uId]" />
                    <DIV class="t">
                        <TABLE cellSpacing="0" cellPadding="0" align="center">
                            <TR>
                                <TD width="10%" class="h" colSpan="3">
                                    <B>编辑回帖</B>
                                </TD>
                            </TR>
                            <TR class="tr3">
                                <TH width="10%">
                                    <B>标题</B>
                                </TH>
                                <TH>
                                    <INPUT class="input" size="60" name="title" value="$reply[title]">
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
                                        <span><textarea id="content" name="content" style="width:500px;height:400px;visibility:hidden;">$reply[content]</textarea> </span>
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
		</div>
	</div>
	<br/>
	<?php echo do_html_footer(); ?>
</body>
</html>