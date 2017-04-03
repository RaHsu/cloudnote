<?php
	require 'myfunc.php';
	
	
	connect_mydb();
	select_mydb();
	
 		
 	$username=_POST('Username');
 	$password=md5(_POST('Password'));
 	
 	
 	
 	 //检查用户名是否存在
 	$result = mysqli_fetch_all(mysqli_query($mydb,"select * from userinformation where username = '$username'"));
 	
 	if(!$result){
 		echo"<script>alert('用户名不存在');history.go(-1);</script>";		
 	}
 	//检查用户名与密码是否匹配
 	else{
 		$row=mysqli_query($mydb,"select password from userinformation where username ='$username'");
 		$row=mysqli_fetch_array($row,MYSQLI_ASSOC);
   		$mypassword=$row['password'];
   		
 		if($mypassword!=$password){
 			echo"<script>alert('密码错误');history.go(-1);</script>";
 		}
 		else{
 			setcookie('username',$username,0);
 			echo '<script type="text/javascript">window.location.href="userHomepage.php"</script>';
 		}
 	}
 	mysqli_close($mydb);
?>