<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>笔记</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link rel="stylesheet" type="text/css" href="css/notedetail.css" />
		<link href="img/logo.ico" rel="shortcut icon" />

	</head>

	<body>
		<?php require 'common.php';?>
		<!--导航条-->
		<?php require 'nav.php' ?>

		<a name="top" id="top"></a>

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

					<!--返回按钮-->
					<a href="shownote.php"><button class="btn btn-info" id="backbtn"><span class="glyphicon glyphicon-chevron-left" ></span>&emsp;返回上页</button></a>
					<!--笔记展示-->

					<?php
						connect_mydb();
						select_mydb();
						
			
						$username=$_COOKIE['username'];
						$id=_POST('id');
						
						
						
						$sql="select * from
						note
						where
						id='$id'
						";
						
						$row=mysqli_fetch_array(query($sql),MYSQLI_ASSOC);
						
						echo '<div class="notebox">
						<h1>';
						echo $row['title'];
						echo '</h1>
						<hr />
						<p>';
						echo $row['content'];
						echo '</p>
						<hr />
						<form action="motifynote.php" method="post">
						<button class="btn btn-info editbtn" type="submit" name="id" value="';
						echo $row['id'];
						echo '"><span class="glyphicon glyphicon-pencil"></span>&emsp;修改</button>
						</form>
						<form action="actionnote.php?action=delete" method="post">
						<button class="btn btn-info deletebtn" type="submit" name="id" value="';
						echo $row['id'];
						echo '"><span class="glyphicon glyphicon-trash"></span>&emsp;删除</button>
						</form>
					</div>';
	
						mysqli_close($mydb);
	
	
						?>
						<!--<div class="notebox">
						<h1>笔记标题</h1>
						<hr />
						<p></p>
						<hr />
						<button class="btn btn-info editbtn"><span class="glyphicon glyphicon-pencil"></span>&emsp;修改</button>
						<button class="btn btn-info deletebtn"><span class="glyphicon glyphicon-trash"></span>&emsp;删除</button>
					</div>-->
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

				function resizeimg() {
					var i;
					var content = document.getElementById("content");
					var imgs = content.getElementsByTagName("img");
					console.log(content.offsetWidth);
					console.log(imgs.length);
					for(i = 0; i < imgs.length; i++) {
						if(imgs[i].width > content.offsetWidth) {
							var bili = imgs[i].width / imgs[i].height;
							imgs[i].width = content.offsetWidth;
							imgs[i].height = (content.offsetWidth / bili);
						}
					}
				}

				resizeimg();
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