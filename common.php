<?php
	require 'myfunc.php';
	//检查用户是否登录
	if(!isset($_COOKIE["username"])){
			echo "<script>alert('请先登录');window.location.href='BeforeHomepage.php';</script>";
		}	
	
	
	//连接数据库以及选择数据库
	connect_mydb();
	select_mydb();
	
	
?>