<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>注册</title>
		<script src="js/jquery-3.0.0.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css"/>
		<link href="img/logo.ico" rel="shortcut icon" />
	</head>

	<body>

		<body>

			<!--模态框-->

			<!--用户名已经存在模态框-->
			<div class="modal fade" id="alreadyexist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">注册失败</h4>
						</div>
						<div class="modal-body">						
							<br />
							用户名已经存在
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info" data-dismiss="modal" onclick="goback()">重新注册</button>
						</div>
					</div>
				</div>
			</div>
			<!--注册成功模态框-->
			<div class="modal fade" id="registed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">注册成功</h4>
						</div>
						<div class="modal-body">							
							<br />
							恭喜你注册成功，点击确定返回登录页面哦\(￣▽￣)/
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info" data-dismiss="modal" onclick="goback()">确定</button>
						</div>
					</div>
				</div>
			</div>
		</body>
		<script type="text/javascript">
			function goback() {
				history.go(-1);
			}
		</script>
		<?php
	require 'myfunc.php';
	
	connect_mydb();
 	
 	select_mydb();
 		
 	$username=_POST('username');
 	$password=md5(_POST('password')); 
 	
 	
 
 	
 	
 	
 	//判断用户是否存在 
 	$result = mysqli_fetch_all(mysqli_query($mydb,"select * from userinformation where username = '$username'"));
 	if($result){
 		echo"<script>$('#alreadyexist').modal('show');</script>";		
 	}
 	else{
 		$sql="insert into userinformation (username,password) values ('$username','$password')";
 		query($sql);
 		echo "<script>$('#registed').modal('show');</script>";
 		
 	}
 	mysqli_close($mydb);
 	
 
 	
 	
?>
			<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
	</body>

</html>