<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>查看笔记</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css"/>
		<link rel="stylesheet" type="text/css" href="css/shownote.css"/>
		<link href="img/logo.ico" rel="shortcut icon" />
		
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

					<!--添加笔记按钮-->
						<a href="editnote.php"><button class="btn btn-info" id="addbtn"><span class="glyphicon glyphicon-plus-sign" ></span>&emsp;添加笔记</button></a>
					<!--笔记展示-->
					
						<!--日程块-->
					<?php
						connect_mydb();
						select_mydb();	
						
						$username=$_COOKIE['username'];
						
						$sql="select * from note where username='$username' order by settime DESC";
						
						$result=query($sql);
						
						$rownumber=mysqli_num_rows($result);
						
						if($rownumber==0){
							echo '<div id="none">
							<p>你现在还没有笔记哦 (*ﾟ▽ﾟ*) 快去添加吧</p>
						</div>';
						}
						
						else{
							$result=fetch_all($sql);
							for($i=0;$i<$rownumber;$i++)
 						{
 							
 							echo '<div class="notebox">';
							echo '<h3>';
							echo $result[$i]["title"];
							echo '</h3></a></form>
							<div class="content">';
							$result[$i]['content']=preg_replace("/<img.*?>/si","[图片]",$result[$i]['content']);
							/*$result[$i]['content']=preg_replace("/<([a-zA-Z]+)[^>]*>/","",$result[$i]['content']);*/
							$result[$i]['content']=preg_replace("/<[^>]*>/sim","",$result[$i]['content']);
							echo stripslashes(substr($result[$i]['content'],0,350));
							echo '</div>
							<p class="time">';
							echo $result[$i]['settime'];
							echo '</p><form action="notedetail.php" method="post">
							<button class="btn btn-info editbtn" name="id" value="';
							echo $result[$i]['id'];
							echo '"><span class="glyphicon glyphicon-search"></span>&emsp;查看</button></form>
							<form action="motifynote.php" method="post"><button class="btn btn-info editbtn" name="id" value="';
							echo $result[$i]['id'];
							echo '"><span class="glyphicon glyphicon-pencil"></span>&emsp;修改</button></form>
							<form action="actionnote?action=delete" method="post"><button class="btn btn-info deletebtn"  name="id" value="';
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
		<script type="text/javascript">
			function sub(){
				document.getElementById("detail").submit();
			}
		</script>
		
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>