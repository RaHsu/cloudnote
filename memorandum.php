<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>备忘</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link rel="stylesheet" type="text/css" href="css/memorandum.css" />
		<link href="img/logo.ico" rel="shortcut icon" />
		<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/sweetalert.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
	</head>

	<body>
		<!--检查用户是否登录-->
		<?php 
		require 'common.php';
	?>
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

				<!--非工具栏-->
				<div id="content">

					<!--输入框-->
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
       						 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
       						 	<!--添加按钮-->
        						  <button id="addbtn" class="btn btn-info"><span class="glyphicon glyphicon-plus-sign" ></span>&emsp;添加备忘</button>
        						</a>
     					 </h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<!--输入表单-->
									<form action="actionmemorandum.php?action=insert" method="post" id="form">
										<textarea class="form-control" id="inputcontent" rows="10" name="content" placeholder="输入你的备忘.....不要超过1000字哦，太多的话写在笔记里吧(｡・`ω´･)"></textarea>
										<button class="btn btn-info" id="savebtn" type="button" onclick="check()"><span class="glyphicon glyphicon-floppy-disk"></span>&emsp;保存</button>

									</form>
									<script type="text/javascript">
										function check() {
											if(document.getElementById("inputcontent").value == '') {
												swal("内容不能为空哦！");
												return false;

											} else {
												form.submit();
											}
										}
									</script>
								</div>
							</div>
						</div>
					</div>

					<!--备忘展示-->

					<?php 
						
						connect_mydb();
						select_mydb();	
						
						$username=$_COOKIE['username'];
						
						$sql="select * from memorandum where username='$username' order by settime DESC";
						
						$result=query($sql);
						
						$rownumber=mysqli_num_rows($result);
						
						if($rownumber==0){
							echo '<div class="none">
							<p>你现在还没有备忘哦 (*ﾟ▽ﾟ*) 快去添加吧</p>
						</div>';
						}
						else{
							$result=fetch_all($sql);
							for($i=0;$i<$rownumber;$i++){
 							echo '<div class="membox">
						<p class="memtext">';
						echo $result[$i]['content'];
						echo '</p>
						<p class="time">';
						echo $result[$i]['settime'];
						echo '</p><form action="actionmemorandum.php?action=delete" method="post">
						<button class="btn btn-info" name="id" value="';
						echo $result[$i]['id'];
						echo '"><span class="glyphicon glyphicon-trash"></span>&emsp;删除</button></form>
					</div>';
					}
 						
						}
						mysqli_close($mydb);
						
						?>

				</div>

			</div>
		</div>
		
		
		<!--返回顶部按钮-->
		<a href="#top">
			<div class="btn btn-info " id="backtotop">
				<span class="up glyphicon glyphicon-chevron-up"></span>
			</div>
		</a>
		
		
		<script type="text/javascript">
			window.onload = function() {
				if(document.body.clientWidth < 1150) {
					document.getElementById("backtotop").style.display = "none";
				} else {
					window.onscroll = function() {
						var t = document.documentElement.scrollTop || document.body.scrollTop;
						if(t > 400) {
							document.getElementById("backtotop").style.display = "block";
						} else {
							document.getElementById("backtotop").style.display = "none";
						}
					}
				}
			}

			window.onresize = function() {
				if(document.body.clientWidth < 1150) {
					document.getElementById("backtotop").style.display = "none";
				} 
			}
		</script>
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>