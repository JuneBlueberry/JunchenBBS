<?php
	/*回帖信息数据表操作方法*/

	header('Content-Type:text/html;charset=utf-8');

	require_once "conn.php";

	/*新增回帖*/
	function addReply($title,$content,$uId,$topicId){
		$format = "%Y/%m/%d %H:%M:%S";
		$publishTime = strftime($format);

		$addStr = "insert into bbs_reply (title,content,publishTime,modifyTime,uId,topicId) values 
				 ('$title','$content','$publishTime','$publishTime',$uId,$topicId)";
		$rs = execUpdate($addStr);
		return $rs;
	} 

	/*修改回帖*/
	function updateReply($replyId,$title,$content){
		$format = "%Y/%m/%d %H:%M:%S";
		$modifyTime = strftime($format);

		$updateStr = "update bbs_reply set title='$title',content='$content',modifyTime='$modifyTime' where replyId=$replyId";
		$rs = execUpdate($updateStr);
		return $rs;
	}

	/*删除回帖*/
	function deleteReply($replyId){
		$delStr = "delete from bbs_reply where replyId = $replyId";
		$rs = execUpdate($delStr);
		return $rs;
	}

	/*根据编号找回帖*/
	function findReplyById($replyId){
		$strQuery = "select * from bbs_reply r,bbs_user u where r.uId=u.uId and r.replyId=$replyId";
		$rs = execQuery($strQuery);
		if(count($rs)>0){
			return $rs[0];
		}
		return $rs;
	}

	/*统计指定帖子的回帖数量*/
	function findCountReply($topicId){
		$strQuery = "select count (*) as nums from bbs_reply where topicId=$topicId";
		$rs = execQuery($strQuery);
		if(count($rs)>0){
			$value = $rs[0]["nums"];
		}
		return $value;
	}

	/*分页获取指定帖子的回帖记录*/
	function findListReply($page,$topicId){
		$pageSize = $GLOBALS["cfg"]["server"]["page_size"];
		if($page >= 1){
			$page --;
		}
		$page *= $pageSize;

		$strQuery = "select * from bbs_reply r,bbs_user u where r.uId=u.uId and r.replyId=$topicId order by publishTime desc limit $page , $pageSize";
		$rs = execQuery($strQuery);
		return $rs;
	}

?>