<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>日程</title>
		<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link href="img/logo.ico" rel="shortcut icon" />

		<link rel="stylesheet" type="text/css" href="css/schedule.css" />
		<script src="js/bootstrap-datetimepicker.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css" />
		<script src="js/locales/bootstrap-datetimepicker.zh-CN.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<!--检查用户是否登录-->
		<?php require 'common.php';?>
		<!--导航条-->
		<?php require 'nav.php' ?>
		<!--头像和介绍-->

		<!--非导航部分-->

		<div id="container">
			<div id="intro">
				<div id="touxiang">

				</div>
				<?php 
					connect_mydb();
					select_mydb();
					$username=$_COOKIE['username'];
					$sql="select userimg from userinformation where username = '$username'";
					$result=fetch_array($sql);
					$result=$result['userimg'];
					echo '<script>document.getElementById("touxiang").style.backgroundImage="'.$result.'";
					</script>';
					mysqli_close($mydb);
					?>
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
				<!--内容部分-->
				<div id="content">
					<!--添加日程-->
					<div id="add">
						<button class="btn btn-info" id="addbtn" data-toggle="modal" data-target="#addform"><span class="glyphicon glyphicon-plus-sign" ></span>&emsp;添加日程</button>

						<!--添加日程模态框-->

						<div class="modal fade" id="addform">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title">添加日程</h4>
									</div>
									<div class="modal-body">
										<!--日程表单-->

										<div >
											<form action="actionschedule.php?action=insert" method="post" id="form">
												<br />
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
													<input type="text" id="timeform" placeholder="活动开始时间" name="starttime" class="form-control">

												</div>
												<br />
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-flag"></span></span>
													<input type="text" class="form-control" placeholder="活动名称" name="theme" id="theme">
												</div>
												<br />
												<input type="button" class="btn btn-info" id="comfirmadd" onclick="check()" value="确认添加"></input>
											</form>
										</div>
										<script type="text/javascript">
											function check(){
												if(document.getElementById("timeform").value==''){
													alert("时间不能为空哦！");
													return false;
												}
												if(document.getElementById("theme").value==''){
													alert("活动名称不能为空哦！");
													return false;
												}
												if(document.getElementById("timeform").value!=''&&document.getElementById("theme").value!=''){
													
													form.submit();
												}
											}
										</script>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">取消添加</button>
									</div>
								</div>

							</div>
						</div>

					</div>

					<!--日程块-->
					<?php
						connect_mydb();
						select_mydb();	
						
						$username=$_COOKIE['username'];
						
						$sql="select * from schedule where username='$username' order by starttime DESC";
						
						$result=query($sql);
						
						$rownumber=mysqli_num_rows($result);
						
						if($rownumber==0){
							echo '<div id="none">
							<p>你现在还没有日程哦 (*ﾟ▽ﾟ*) 快去添加吧</p>
						</div>';
						}
						
						else{
							$result=fetch_all($sql);
							for($i=0;$i<$rownumber;$i++)
 						{
 							$nowtime=strtotime(date('y-m-d h:i',time()));
 							$thistime=strtotime($result[$i]['starttime']);
 							
 							
 							if($nowtime<$thistime){
 								
 								echo'<div class="schedulebox">
							<h3 class="scheduletitle">';
							echo $result[$i]['theme'];
							echo '&emsp;<span class="label label-default">未进行</span></h3>
							<p class="time">';
							echo $result[$i]['starttime'];
							echo '</p>';
							echo '<form action="actionschedule.php?action=delete" method="post">';
							echo '<button class="btn btn-info deletebtn" name="id" value="';
							echo $result[$i]['id'];
							echo '">删除</button>';
							echo '<form>';
							echo '</div>';
							
 							}
 							else{
 								echo'<div class="schedulebox">
							<h3 class="scheduletitle">';
							echo $result[$i]['theme'];
							echo '&emsp;<span class="label label-info">已完成</span></h3>
							<p class="time">';
							echo $result[$i]['starttime'];
							echo '</p>';
							echo '<form action="actionschedule.php?action=delete" method="post">';
							echo '<button class="btn btn-info deletebtn" name="id" value="';
							echo $result[$i]['id'];
							echo '">删除</button>';
							echo '<form>';
							echo '</div>';
 							}
 							}
						}
						mysqli_close($mydb);
				?>

				</div>

			</div>

		</div>

		<script type="text/javascript">
			$('#timeform').datetimepicker({
				format: 'yyyy-mm-dd hh:ii',
				autoclose: true,
				todayBtn: true,
				pickerPosition: "bottom-left",
				language: 'zh-CN',
			});
		</script>
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>