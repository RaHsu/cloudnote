<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>编辑笔记</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/nav.css" />
		<link rel="stylesheet" type="text/css" href="css/simditor.css" />
		<link rel="stylesheet" type="text/css" href="css/editnote.css" />
		<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/module.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/hotkeys.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/uploader.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/simditor.js" type="text/javascript" charset="utf-8"></script>
		<!--<script src="js/simditor-autosave.js" type="text/javascript" charset="utf-8"></script>-->
		<script src="js/simditor-mark.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/simditor-fullscreen.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/simditor-fullscreen.css"/>
		<link href="img/logo.ico" rel="shortcut icon" />
		
	</head>

	<body>

		<?php require 'common.php';?>
		<!--导航条-->
		<?php require 'nav.php'; ?>
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
					<div id="back">
						<a href="shownote.php"><button class="btn btn-info"><span class="glyphicon glyphicon-chevron-left"></span>&emsp;返回</button></a>
					</div>
					<form action="actionnote.php?action=insert" method="post" id="form">
						<div id="edittitle">
							<input type="text" class="form-control" id="inputtitle" name="title" placeholder="输入笔记标题" style="border-radius: 0px;"/>
						</div>
						<div id="edit">
							<textarea id="editor" name="content" placeholder="输入你的笔记" ></textarea>
						</div>

						<input type="hidden"  id="content" />
						<div id="save">
							<button class="btn btn-info" type="button" onclick="check()"><span class="glyphicon glyphicon-floppy-disk"></span>&emsp;保存笔记</button>
						</div>

					</form>
				</div>
				<script type="text/javascript">
					function check(){
						if(document.getElementById("inputtitle").value==''){
							alert("标题不能为空哦！");
							return false;
						}
						else if(document.getElementById("editor").value==""){
							alert("内容不能为空哦！");
							return false;
						}
						else{
							form.submit();
						}
					}
				</script>
			</div>
		</div>
		<script type="text/javascript">
		
		var editer = new Simditor({
				textarea: $('#editor'),
				toolbar: [
					'title',
					'bold',
					'italic',
					'mark',
					'underline',
					'strikethrough',
					'fontScale',
					'color',
					'ol',
					'ul',
					'blockquote',
					'code',
					'table',
					'link',
					'image',
					'hr',
					'indent',
					'outdent',
					'alignment',
					'fullscreen',
				],
				/*autosavePath: 'autosave/',*/
					/*upload : {
           			 url : 'uploadimg.php', //文件上传的接口地址
           			 params: null, //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
            		 fileKey: 'file', //服务器端获取文件数据的参数名
           			 connectionCount: 3,
           			 leaveConfirm: '正在上传文件'
           			 
        } ,*/
        		pasteImage:true,
			});

			
			
		
		</script>
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>