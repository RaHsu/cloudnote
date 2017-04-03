<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>用户主页</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css" />		
		<script src="js/jquery-3.0.0.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/userHomepage.css"/>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
		<script src="js/sweetalert.js" type="text/javascript" charset="utf-8"></script>
		<link href="img/logo.ico" rel="shortcut icon" />
	</head>

	<body>
		<?php require 'common.php';?>
		<!--导航条-->
		<?php require 'nav.php'?>
		
		
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
					<p class="name"><?php echo $_COOKIE['username']; ?></p>
				</div>
				<div id="motto">
					<p class="motto" ><?php 						
							connect_mydb();
							select_mydb();
							global $username;
							$username=$_COOKIE['username'];
							$row=mysqli_query($mydb,"select motto from userinformation where username ='$username'");
 							$row=mysqli_fetch_array($row,MYSQLI_ASSOC);							
   							$motto=$row['motto'];
   							echo $motto;
							mysqli_close($mydb);
						?></p>
				</div>
			</div>
			<!--非标头部分-->
			<div id="non-intro">
				<!--工具栏部分-->
				<div id="toolbox">
					<div id="toolbar">
						<ul>
							<a href="userHomepage.php" class="activea"><li><span class="glyphicon glyphicon-user"></span>&emsp;我的主页&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li></a>
							<a href="updatedata.php"><li><span class="glyphicon glyphicon-align-left"></span>&emsp;我的资料&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li></a>
							<a href="schedule.php"><li><span class="glyphicon glyphicon-calendar"></span>&emsp;我的日程&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li></a>
							<a href="memorandum.php"><li><span class="glyphicon glyphicon-list-alt"></span>&emsp;我的备忘&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li></a>
							<a href="shownote.php"><li><span class="glyphicon glyphicon glyphicon-book"></span>&emsp;我的笔记&emsp;&emsp;<span class="glyphicon glyphicon-chevron-right"></span></li></a>												
						</ul>
					</div>
				</div>
				<!--文章部分-->
				<!--日程-->
				<div id="textbox">
					<div id="canbox" class="textbox">
						<p class="boxtitle">最新日程
							<a class="more" href="schedule.php">
								<button  class="btn btn-info"vdata-toggle="tooltip" data-placement="left" title="添加，修改和删除你的日程"><span class="glyphicon glyphicon-pencil"></span>&emsp;更多操作</button>
							</a>
						</p>
						
						<hr />
						<?php
						connect_mydb();
						select_mydb();	
						
						$username=$_COOKIE['username'];
						
						$sql="select * from schedule where username='$username' order by starttime DESC" ;
						
						$result=query($sql);
						
						$rownumber=mysqli_num_rows($result);
						
						if($rownumber==0){
							echo '<div id="none">
							<p>你现在还没有日程哦 (*ﾟ▽ﾟ*) 快去添加吧</p>
						</div>';
						}
						
						else{
							$result=fetch_all($sql);
							for($i=0;$i<($rownumber>3?3:$rownumber);$i++)
 						{
 							$nowtime=strtotime(date('y-m-d h:i',time()));
 							$thistime=strtotime($result[$i]['starttime']);
 							
 							
 							if($nowtime<$thistime){
 								echo'<div class="cantextbox">
							<h3 class="cantheme">';
							echo $result[$i]['theme'];
							echo '&emsp;<span class="label label-default">未进行</span></h3>
							<p class="time">';
							echo $result[$i]['starttime'];
							echo '</p>
						</div>';
 							}
 							else{
 								echo'<div class="cantextbox">
							<h3 class="cantheme">';
							echo $result[$i]['theme'];
							echo '&emsp;<span class="label label-info">已完成</span></h3>
							<p class="time">';
							echo $result[$i]['starttime'];
							echo '</p>
						</div>';
 							}
 							}
						}
						mysqli_close($mydb);
				?>
						
					</div>
					<!--备忘-->
					<div id="membox" class="textbox">
						<p class="boxtitle">最新备忘
						<a class="more" href="memorandum.php">
							<button  class="btn btn-info"vdata-toggle="tooltip" data-placement="left" title="添加，修改和删除你的备忘"><span class="glyphicon glyphicon-pencil"></span>&emsp;更多操作</button>
							</a></p>
						<hr />
						
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
							for($i=0;$i<($rownumber>3?3:$rownumber);$i++){
 							echo '<div class="membox">
						<p class="memtext">';
						echo $result[$i]['content'];
						echo '</p>
						<p class="time">';
						echo $result[$i]['settime'];
						echo '</p>
					</div>';
					}
 						
						}
						mysqli_close($mydb);
						
						?>
					</div>
					
					<!--笔记-->
					<div id="notebox" class="textbox">
						<p class="boxtitle">最新笔记
							<a class="more" href="shownote.php">
								<button  class="btn btn-info"vdata-toggle="tooltip" data-placement="left" title="添加，修改和删除你的笔记"><span class="glyphicon glyphicon-pencil"></span>&emsp;更多操作</button>
							</a>
						</p>
						
						<hr />
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
							for($i=0;$i<($rownumber>3?3:$rownumber);$i++)
 						{
 							echo '<div class="notebox">';
							echo '<h3>';
							$result[$i]['content']=preg_replace("/<img.*?>/si","[图片]",$result[$i]['content']);
							/*$result[$i]['content']=preg_replace("/<([a-zA-Z]+)[^>]*>/","",$result[$i]['content']);*/
							$result[$i]['content']=preg_replace("/<[^>]*>/sim","",$result[$i]['content']);
	
							echo $result[$i]["title"];
							echo '</h3></a></form>
							<div class="content">';
							echo stripslashes(substr($result[$i]['content'],0,350));
							echo '</div>
							<p class="time">';
							echo $result[$i]['settime'];
							echo '</p>
						</div>';
 								
 							
 							}
 							
 							}
						
						mysqli_close($mydb);
				?>
					</div>
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
		
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js "></script>
		<script src="js/bootstrap.min.js "></script>
	</body>
	

</html>