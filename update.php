<!DOCTYPE html>
<html lang="zh-cn">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>更新信息表单处理</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="img/logo.ico" rel="shortcut icon" />
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
		<script src="js/sweetalert.js" type="text/javascript" charset="utf-8"></script>

	</head>

	<body>
		<?php 
			
			require 'common.php';
			
			$action=isset($_GET['action'])?$_GET['action']:'';
			
			if($action=='info'){
 			
 			$sex=_POST('sex');
 			$motto=_POST('motto');
 			$email=_POST('email');
 			$telenumber=_POST('telenumber');
 			$username=$_COOKIE["username"];
 			
   		$sql="UPDATE 
						userinformation 
					SET 
						sex='$sex', 
						motto='$motto',
						email='$email',
						phonenumber='$telenumber' 
					WHERE 
						username = '$username'
				";
 									
 			query("$sql");
 	
 			mysqli_close($mydb);
 			
 			echo "<script>self.location='userHomepage.php'; </script>";
 		}
 		
 		if($action=='img'){
 			
 				$username=$_COOKIE["username"];
 			
				if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/png")
				|| ($_FILES["file"]["type"] == "image/pjpeg"))
				&& ($_FILES["file"]["size"] < 2097152))
 			 {
 			 if ($_FILES["file"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  			  }
 			 else
  			  {
  			 	/*echo "Upload: " . $_FILES["file"]["name"] . "<br />";
				echo "Type: " . $_FILES["file"]["type"] . "<br />";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";*/
				
				//改变文件名字
				
				function name(){
				global $filename;
				static $no=0;
				$no++;
				if($_FILES["file"]["type"] == "image/gif")
				{
				$filename=$no.'.gif';
				}
				if($_FILES["file"]["type"] == "image/jpeg")
				{
				$filename=$no.'.jpeg';
				}if($_FILES["file"]["type"] == "image/png")
				{
				$filename=$no.'.png';
				}if($_FILES["file"]["type"] == "image/pjpeg")
				{
				$filename=$no.'.pjpeg';
				}
				}
				
				do{name();}
				while(file_exists("userimg/" . $filename));
				
				
				
				//存入服务器文件夹
 				move_uploaded_file($_FILES["file"]["tmp_name"],
 				"userimg/" . $filename);
 				echo "Stored in: " . "userimg/" . $filename;
 				
 				//存入数据库
				$filename="url("."userimg/".$filename.")";
				
				$sql="update userinformation set userimg = '$filename' where username = '$username'";
				
				query($sql);
      
    }
  }
else
  {
  echo "<script>alert('文件类型错误或文件大于2M')</script>";
  }
  
  		echo "<script>self.location='updatedata.php'</script>";
 			
 		}
 		
 		/*修改密码*/
 		if($action=='changepassword'){
 			$username=$_COOKIE['username'];
 			$inputoldpassword=md5(_POST('oldpassword'));
 			$newpassword=md5(_POST('newpassword'));
 			
 			/*确认旧密码与用户名是否匹配*/
 			$sql="select password from userinformation where username='$username'";
 			
 			$result=fetch_array($sql);
 			
 			$password=$result['password'];
 			
 			if($inputoldpassword==$password){
 				$change="update userinformation set password = '$newpassword' where username = '$username'";
 				query($change);
 				setcookie("username");
 				echo '<script>swal("修改成功，点击转跳至登录页面");</script>';
 				echo "<script>self.location='BeforeHomepage.php';</script>";
 			}
 			else{
 				echo '<script>swal("密码输入错误");</script>';
 				echo "<script>self.location='updatedata.php';</script>";
 			}
 		}
 			mysqli_close($mydb);
			?>

		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>