<?php
	require 'common.php';
	
	$action=isset($_GET['action'])?$_GET['action']:'';
	
	//添加笔记
	
	if($action=="insert"){
		
	$username=$_COOKIE['username'];
	$title=_POST('title');
	$content=addslashes(_POST('content'));
	$settime=date('y-m-d h:i:s',time());
	
	$sql="insert into
			note
			(username,settime,title,content)
			values('$username','$settime','$title','$content');
	";
	
	query($sql);
	
	mysqli_close($mydb);
	
	echo "<script>self.location='shownote.php';</script>";
	}
	
	
	
	//删除笔记
	
	if($action=="delete"){
		echo 'in';
		$username=$_COOKIE['username'];
		$id=_POST('id');
		
		echo $id;
		$sql="delete from note where id = '$id'";
				
		query($sql);
		
		mysqli_close($mydb);
		
		echo "<script>self.location='shownote.php';</script>";
	
	}
	
	//更新笔记
	
	if($action=="update"){
		
	$username=$_COOKIE['username'];
	$title=_POST('title');
	$content=addslashes(_POST('content'));
	
	$settime=date('y-m-d h:i:s',time());
	$id=_POST('id');
	

	$sql="update
			note
		  set 	
			settime='$settime',title='$title',content='$content'
			where id='$id'
	";
	
	query($sql);
	
	$sqll="select content from note where id = '$id' ";
	
	$reslut=fetch_all($sqll);
	
	var_dump($reslut);
	
	mysqli_close($mydb);
	
	echo "<script>self.location='shownote.php';</script>";
	}
?>