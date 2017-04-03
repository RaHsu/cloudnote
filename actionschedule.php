<?php
	require 'common.php';
	
	$action=isset($_GET['action'])?$_GET['action']:'';
	
	//添加日程操作
	
	if($action=="insert"){
		
	$username=$_COOKIE['username'];
	$starttime=_POST('starttime');
	$settime=date('y-m-d h:i:s',time());
	$theme=_POST('theme');
	
	$sql="insert into
			schedule
			(username,starttime,settime,theme)
			values('$username','$starttime','$settime','$theme');
	";
	
	query($sql);
	
	mysqli_close($mydb);
	
	echo "<script>self.location='schedule.php';</script>";
	}
	
	
	//删除日程操作
	if($action=="delete"){
		$username=$_COOKIE['username'];
		$id=_POST('id');
		$sql="delete from schedule where id = '$id'";
		
		query($sql);
		
		mysqli_close($mydb);
		echo "<script>self.location='schedule.php';</script>";
	
		
		
	}
	

?>