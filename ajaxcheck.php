<?php 
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
 	
			
			?>