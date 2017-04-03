<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>关于我们</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link rel="stylesheet" type="text/css" href="css/about.css" />
		<link href="img/logo.ico" rel="shortcut icon" />
		
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
					<a class="navbar-brand" href="BeforeHomepage.html">CloudNote</a>
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
						<form action="login.php" method="post">
							<div class="panel panel-default zhucekuang">
								<div class="panel-heading zhuce">登录</div>
								<div class="panel-body">

									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
										<input type="text" class="form-control" placeholder="Username" name="Username">
									</div>
									<br />
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
										<input type="password" class="form-control" placeholder="Password" name="Password">
									</div>
									<br />

									<button type="submit" class="btn btn-info btn-lg btn-block">登录</button>

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
										<input type="text" class="form-control" placeholder="Username" name="username" />
									</div>
									<br />
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
										<input type="password" class="form-control" placeholder="Password" name="password" />
									</div>
									<br />
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
										<input type="password" class="form-control" placeholder="Comfirm Username" name="confirm">
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

		<!--介绍-->
		<div class="jumbotron">
			<h1>关于Cloudnote</h1>
			<p>我一直期待的纯净，简单的云笔记。</p>

		</div>

		<!--联系我-->
		<div id="contact">
			<h2>关于我</h2>
			<hr />
			<p>wingstudio&nbsp;许娜</p>
			<p><span class="glyphicon glyphicon-earphone"></span>&emsp;电话：15828350242</p>
			<p><span class="glyphicon glyphicon-envelope"></span>&emsp;邮箱：496081759@qq.com</p>
			<a href="https://mail.qq.com/" target="_blank"><button class="btn btn-info">去发邮件</button></a>

		</div>
		<hr />

		<!--友情链接-->
		<div class="container">

			<div id="links" class="row">
				<div id="title" class="col-lg-5 col-xs-12">
					<div id="biaoti">
						<div>
							<div id="logo">
							</div>
							<h1>Cloudnote友情链接</h1>
						</div>
					</div>
				</div>
				<div id="linksss" class="col-lg-7 col-xs-12">
					<div id="about">
						<h4>关于我</h4>
						<br />
						<a href="http://www.wingstudio.org/">Wing Studio工作室</a>
					</div>
					<div id="friend">
						<h4>友情链接</h4>
						<br />
						<a href="http://www.bootcss.com/">Bootstrap中文网</a>
						<br />
						<br />
						<a href="http://simditor.tower.im/">Simditor编辑器</a>
					</div>
				</div>
			</div>
		</div>
		<h6 class="banquan">© 2016 note.ratsui.cn  </h6>
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript ">
		function backtohome(){
			location.href="BeforeHomepage.html ";
		}		
	</script>
	</body>

</html>