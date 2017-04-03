<?php
	echo'<!--导航条-->
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;';
								 echo $_COOKIE["username"]; echo '&nbsp;<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="userHomepage.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;我的主页</a>
								</li>
								<li>
									<a href="updatedata.php"><span class="glyphicon glyphicon-align-left"></span>&nbsp;&nbsp;我的资料</a>
								</li>
								<li>
									<a href="schedule.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;日程</a>
								</li>
								<li>
									<a href="memorandum.php"><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;备忘</a>
								</li>
								<li>
									<a href="shownote.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;笔记</a>
								</li>
								<li class="divider"></li>
								<li data-toggle="modal" data-target="#comfirmExit">
									<a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;退出登录</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>';
		
		echo '<!--退出登录模态框-->
		<div class="modal fade" id="comfirmExit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">确认</h4>
					</div>
					<div class="modal-body">
						你确认要退出登录吗？
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<form action="nav.php?action=exit" method="post" style="display:inline-block;">
						<button type="submit" class="btn btn-info" formtarget="_self "> 确认退出</button>
						</form>
					</div>
				</div>
			</div>
		</div>';
		
		
		
	
		$action=isset($_GET['action'])?$_GET['action']:'';
		if($action=='exit'){
			setcookie("username");
			/*Header("location:BeforeHomepage.php");*/
			echo '<script>window.location.href="BeforeHomepage.php";</script>';
			echo '<script>self.close();</script>';
			exit;
		}
		
		
?>