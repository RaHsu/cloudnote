<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>修改个人资料</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link rel="stylesheet" type="text/css" href="css/updatedata.css" />
		<link href="img/logo.ico" rel="shortcut icon" />
		<script src="js/sweetalert.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
	</head>

	<body>
		<?php require 'common.php';?>
		<!--导航条-->
		<?php require 'nav.php' ?>
		<!--头像和介绍-->
		<!--非导航部分-->

		<div id="container">
			<div id="intro">

				<div id="touxiang">

				</div>

				<div id="name">
					<p class="name">
						<?php echo $_COOKIE['username']; ?>
					</p>
				</div>
				<div id="motto">
					<p class="motto">
						<?php 
							connect_mydb();
							select_mydb();
							global $username;
							$username=$_COOKIE['username'];
							$row=mysqli_query($mydb,"select motto from userinformation where username ='$username'");
 							$row=mysqli_fetch_array($row,MYSQLI_ASSOC);							
   							$motto=$row['motto'];
   							echo $motto;
							mysqli_close($mydb);
						?>
					</p>
				</div>
			</div>

			<!--非标头部分-->
			<div id="non-intro">
				<!--工具栏部分-->
				<div id="toolbox">
					<div id="toolbar">
						<ul>
							<a href="userHomepage.php">
								<li><span class="glyphicon glyphicon-user"></span>&emsp;我的主页&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li>
							</a>
							<a href="updatedata.php">
								<li><span class="glyphicon glyphicon-align-left"></span>&emsp;我的资料&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li>
							</a>
							<a href="schedule.php">
								<li><span class="glyphicon glyphicon-calendar"></span>&emsp;我的日程&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li>
							</a>
							<a href="memorandum.php">
								<li><span class="glyphicon glyphicon-list-alt"></span>&emsp;我的备忘&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li>
							</a>
							<a href="shownote.php">
								<li><span class="glyphicon glyphicon glyphicon-book"></span>&emsp;我的笔记&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li>
							</a>
						</ul>
					</div>
				</div>

				<!--非工具栏-->
				<div id="content">
					<!--表单-->
					<form action="update.php?action=img" method="post" enctype="multipart/form-data">
						<!--更换头像-->
						<div id="updateimg">
							<span class="title">头像：</span>
							<div id="smalltouxiang">
								·
							</div>
							<div id="cover">
								选择文件
								<input id="file" type="file" name="file" value="点击修改头像" />
							</div>

							<button class="btn btn-info" type="submit">提交</button>
						</div>

					</form>
					<?php 
					connect_mydb();
					select_mydb();
					$username=$_COOKIE['username'];
					$sql="select userimg from userinformation where username = '$username'";
					$result=fetch_array($sql);
					$result=$result['userimg'];
					echo '<script>document.getElementById("touxiang").style.backgroundImage="'.$result.'";
							document.getElementById("smalltouxiang").style.backgroundImage="'.$result.'";
					</script>';
					mysqli_close($mydb);
					?>

					<div id="updateusername">
						<span class="title">用户名：</span>
						<span class="contenttext"><?php echo $_COOKIE['username']; ?></span>
					</div>
					<div id="updatepassword">
						<span class="title">密码：</span>
						<button class="btn btn-info" data-toggle="modal" data-target="#changepassword">点击修改密码</button>
					</div>
					<!--修改密码模态框-->
					<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="myModalLabel">修改密码</h4>
								</div>
								<div class="modal-body">
									<div >
										<form action="update.php?action=changepassword" method="post" id="form">
											<br />
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
												<input type="password" id="oldpassword" placeholder="输入旧密码" name="oldpassword" class="form-control">

											</div>
											<br />
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
												<input type="password" class="form-control" placeholder="输入新密码" name="newpassword" id="newpassword">
											</div>
											<br />
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
												<input type="password" class="form-control" placeholder="确认新密码" name="confirmnewpassword" id="confirmnewpassword">
											</div>
											<br/>
											<input type="button" class="btn btn-info" value="确认修改" style="width: 100%;" onclick="check()"></input>	
										</form>
									</div>
									<script type="text/javascript">
										function check(){
											if(document.getElementById("oldpassword").value==""){
												swal("请输入旧密码");
												return false;
											}
											else if(document.getElementById("newpassword").value==""){
												swal("请输入新密码");
												return false;
											}
											else if(document.getElementById("confirmnewpassword").value==""){
												swal("请确认新密码");
												return false;
											}
											else if(document.getElementById("newpassword").value!=document.getElementById("confirmnewpassword").value){
												swal("两次密码输入不符");
												return false;
											}
											else{
												form.submit();
											}
											
										}
									</script>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
									</div>
								</div>
							</div>
						</div>
						</div>

						<form action="update.php?action=info" method="post">

							<div id="updatesex">
								<span class="title">性别：</span>
								<input type="radio" name="sex" id="sex" value="male" />&emsp;男&emsp;&emsp;
								<input type="radio" name="sex" id="sex" value="female" />&emsp;女
							</div>
							<div id="updatemotto">
								<span class="title">签名：</span>
								<textarea type="text" id="" value="" class="form-control myinputtext" rows="3" placeholder="输入你的签名" name="motto"></textarea>
							</div>
							<div id="updateemail">
								<span class="title">邮箱：</span>
								<input type="text" class="form-control myinputtext" placeholder="输入你的有效邮箱账号" name="email">
							</div>
							<div id="updatetele">
								<span class="title">手机号：</span>
								<input type="text" class="form-control myinputtext" placeholder="输入你的有效手机号" name="telenumber">
							</div>
							<div id="submitbtn">
								<button class="btn btn-info" type="submit">保存</button>&emsp;&emsp;
								<button class="btn btn-default">取消</button>
							</div>

						</form>

					</div>

				</div>

			</div>
		</div>
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>