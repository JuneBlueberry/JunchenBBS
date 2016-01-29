<?php
	/*帖子信息表数据操作方法*/

	header('Content-Type:text/html;charset=utf-8');

	require_once "conn.php";

	/*发表帖子*/
	function addTopic($title,$content,$uId,$boardId){
		$format = "%Y/%m/%d %H:%M:%S";		//设置时间格式
		$publishTime = strftime($format);	//获取当前时间

		$addStr = "insert into bbs_topic (title,content,publishTime,modifyTime,uId,boardId) values ('$title','$content','$publishTime','$publishTime','$uId','$boardId')";

		$rs = execUpdata($addStr);
		return $rs;
	}

	/*修改帖子信息*/
	function updateTopic($topicId,$title,$content){
		$format = "%Y/%m/%d %H:%M:%S";		//设置时间格式
		$modifyTime = strftime($format);	//获取当前时间

		$updateStr = "update bbs_topic set title='$title',content='$content',modifyTime='$modifyTime' where topicId='$topicId'";
		$rs = execUpdata($updateStr);
		return $rs;
	}

	/*删除指定帖子*/
	function deleteTopic($topicId){
		$delStr = "delete from bbs_topic where topicId = '$topicId'";
		$rs = execUpdata($delStr);
		return $rs;
	}

	/*根据编号查询帖子信息*/
	function findTopicById($topicId){
		$strQuery = "select * from bbs_topic t,bbs_user u where t.uId=u.uId and topicId='$topicId'";
		$rs = execQuery($strQuery);
		if(count($rs)>0){
			return $rs;
		}
		return $rs;
	}

	/*统计版块发表帖子数*/
	function findCountTopic($boardId){
		$strQuery = "select count(*) as nums from bbs_topic where boardId='$boardId'";
		$rs = execQuery($strQuery);
		$value = 0;
		if(count($rs)>0){
			$value = $rs[0]["nums"];
		}
		return $value;
	}

	/*取版块最新帖子*/
	function findLastTopic($boardId){
		$strQuery = "select * from bbs_topic t,bbs_user u where t.uId=u.uId and boardId=$boardId order by publishTime desc limit 0,1";
		$rs = execQuery($strQuery);
		if(count($rs)>0){
			return $rs[0];
		}
		return $rs;
	}

	/*分页却帖子信息*/
	function findListTopic($page,$boardId){
		$pageSize = $GLOBALS["cfg"]["server"]["page_size"];
		if($page >= 1){		//分页处理
			$page --;
		}
		$page *= pageSize;

		//分页查询
		$strQuery = "select * from bbs_topic t,bbs_user u where t.uId=u.uId and boardId=$boardId order by publishTime desc limit $page ,$pageSize";
		$rs = execQuery($strQuery);
		return $rs;
	}
?>