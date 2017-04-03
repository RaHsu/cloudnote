


<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>cloudnote</title>
		<script src="js/checkregister.js" type="text/javascript" charset="utf-8"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link rel="stylesheet" type="text/css" href="css/beforehomepage.css" />
		<link href="img/logo.ico" rel="shortcut icon" />
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
		<script src="js/sweetalert.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		

		
		<?php 
			if(isset($_COOKIE["username"])){
				 require 'nav.php'; 
			}
			else{
				echo'<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">CloudNote</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
					<a class="navbar-brand" href="BeforeHomepage.php">CloudNote</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="BeforeHomepage.php">首页</a>
						</li>
						<li>
							<a href="about.php">关于我们</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<li>
								<a href="#" data-target="#login" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;登录</a>
							</li>
						</li>
					</ul>
				</div>
			</div>
		</nav>';
			}
			?>
		<!--导航条-->
		
	

		<!--登陆模态框-->
		<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">登录</h4>
					</div>
					<div class="modal-body">
						<!--
                    	登录表单
                    -->
						<form action="login.php" method="post" id="log">
							<div class="panel panel-default zhucekuang">
								<div class="panel-heading zhuce">登录</div>
								<div class="panel-body">
									
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
											<input type="text" class="form-control" placeholder="用户名" name="Username" id="Username">
										</div>
										<br />
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
											<input type="password" class="form-control" placeholder="密码" name="Password" id="Password">
										</div>
										<br />

										<input type="submit" class="btn btn-info btn-lg btn-block" value="登录">
									
								</div>
							</div>

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" data-target="#register" data-toggle="modal">去注册>></button>

					</div>
				</div>
			</div>
		</div>
		<!--
        	注册模态框
        -->
		<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">注册</h4>
					</div>
					<div class="modal-body">
						<!--
                    	注册表单
                    -->
						<form action="register.php" method="post" id="zhuce">
							<div class="panel panel-default zhucekuang">
								<div class="panel-heading zhuce">注册</div>
								<div class="panel-body">
									
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
											<input type="text" class="form-control" placeholder="请输入用户名" name="username" onblur="checkusername()" id="username"/>
										</div>
										<br />
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
											<input type="password" class="form-control" placeholder="请输入密码" name="password" />
										</div>
										<br />
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
											<input type="password" class="form-control" placeholder="请确认密码" name="confirm">
										</div>
										<br />
										<input type="button" class="btn btn-info btn-lg btn-block" value="注册" onclick="checkR()">
									
								</div>
							</div>

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" data-target="#login" data-toggle="modal">去登录>></button>

					</div>
				</div>
			</div>
		</div>

		<!--首页图片-->

		<div id="homepic">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h1 id="logotext">CloudNote</h1>
						<h2 id="logoinfo">纯粹，便捷的云笔记</h2>
					</div>
				</div>
			</div>

		</div>
		
		<!--功能介绍-->
		
		<div class="row container1">
			<h1 id="title1">为什么要拥有自己的云笔记？</h1>
			<div class="col-md-4 col-xs-12 intro">
				<img src="img/calender.svg" class="homepageimg" style="width: 150px;height: 125px;"/>
				<h2 class="smalltitle">日程</h2>
				<p class="smallintto">记录生活点滴日程</p>
				<p class="smallintto">再也不怕自己忘了重要事务</p>
			</div>
			<div class="col-md-4 col-xs-12 intro">
				<img src="img/notebook.svg" class="homepageimg" style="width: 150px;height: 125px;"/>
				<h2 class="smalltitle">笔记</h2>
				<p class="smallintto">学习资料随身携带</p>
				<p class="smallintto">随时随地轻松查看</p>
			</div>
			<div class="col-md-4 col-xs-12 intro">
				<img src="img/cloud.svg" class="homepageimg" style="width: 150px;height: 125px;"/>
				<h2 class="smalltitle">云端存储</h2>
				<p class="smallintto">资料保存在云端</p>
				<p class="smallintto">多终端登录 从此没有限制</p>
			</div>
		</div>
		</div>
		
		<!--登录和注册-->
		
		<div id="logAndRegis">
			<img src="img/note.png"/ style="padding: 40px;">
			<h2>CloudNote</h2>
			<h3>你值得拥有的云笔记</h3>
			<button class="btn btn-info" id="btnlogin" data-target="#login" data-toggle="modal">登录</button>
			<button class="btn btn-default" id="btnregis" data-target="#register" data-toggle="modal">注册</button>
			<hr />
			<h6 class="banquan">© 2016 note.ratsui.cn  </h6>
		</div>
		
		<!--动态检查用户名是否存在-->
		<script type="text/javascript">
			function checkusername(username){
				var username=document.getElementById("username").value;
				var check=new XMLHttpRequest();
				console.log(username);
				var myurl="ajaxcheck.php?action=check&username="+username+'&sid='+Math.random();
				console.log(myurl);
				check.open("GET",myurl,true);
				check.send(null);
				check.onreadystatechange=function(){
					if(check.readyState==4||check.readyState==200){
						console.log(check.responseText);
						if(check.responseText==1){
							swal("用户名已经存在");
						}												
					}
				}
				
			}
			
			
		</script>
		
		

		
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
	


</html>

	
		<!--		<?php 
			require 'myfunc.php';
	
			connect_mydb();
 	
 			select_mydb();
 		
 			$username=isset($_GET['username'])?$_GET['username']:'';
 	
 			$action=isset($_GET['action'])?$_GET['action']:'';
 			
 		
 					/*异步检查*/
 	
 				if ($action=='check'){
 					$result = mysqli_fetch_all(mysqli_query($mydb,"select * from userinformation where username = '$username'"));
 					if($result){
 					echo 1;		
 				}
 				exit();
 				
 			}
 	
			
			?>-->