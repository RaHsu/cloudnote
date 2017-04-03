<?php
	
	require 'common.php';
	
	$action=isset($_GET['action'])?$_GET['action']:'';
	
	//添加备忘
	
	if($action=="insert"){
		
	$username=$_COOKIE['username'];
	$content=_POST('content');
	$settime=date('y-m-d h:i:s',time());
	
	$sql="insert into
			memorandum
			(username,content,settime)
			values('$username','$content','$settime');
	";
	
	query($sql);
	
	mysqli_close($mydb);
	
	echo "<script>self.location='memorandum.php';</script>";
	}
	
	//删除备忘
	
	if($action=="delete"){
		$username=$_COOKIE['username'];
		$id=_POST('id');
		
		echo $id;
		$sql="delete from memorandum where id = '$id'";
		
		query($sql);
		
		mysqli_close($mydb);
		
		echo "<script>self.location='memorandum.php';</script>";
	
	}

?>