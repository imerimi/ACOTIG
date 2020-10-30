<?php 
	session_start();
	
	$host="localhost";
	$user="root";
	$password="";
	$db="acotig";
	
	mysql_connect($host,$user,$password);
	mysql_select_db($db);
	
	$error="";
	
	if (isset($_POST['submit'])){
		if(empty($_POST['id']) || empty($_POST['password'])){
			$error = 'Please enter the info needed';
		}
		else{
			$id=$_POST['id'];
			$pwd=$_POST['password'];
			$sql="select * from user where id='".$id."'AND password='".$pwd."'";
		
			$result=mysql_query($sql);
		
			if(mysql_num_rows($result)==1){
				header("location:main.php");
			}
			else{
				$error= "Incorrect Input";
			}
			
			
		}
	}
?>


<!DOCTYPE html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ACOTIG-Automated College Timetable Generator</title>
	  <link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="reset.css"/>
      <link rel="stylesheet" type="text/css" href="login.css"/>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src=" "></script>
	  <style>.error{
	color:red;
	margin-bottom:5px;
}</style>
   </head>
   <body>
		<img class="wave" src="img/wave.png">
		<div class="container">
			<h1>Automated College Timetable Generator</h1>
			<div class="bg_img">
				<img src="img/login_bg.png" >
			</div>
			 <div class="main">
				<form method="post" action="" id="mainForm">
					<div class="robot_img">
						<img src="img/robot.png" >
					</div>
					<h2> Hello! </h2>
					<div class="input_div">
					   <p><i class="fa fa-user "></i>
						  <input type="text" name="id" class="input" placeholder="Username" autocomplete="off">
					   </p>
					</div>
					<div class="input_div">
					   <p><i class="fa fa-lock"></i>
						  <input type="password" name="password" class="input" placeholder="Password">
					   </p>
					</div>
					<div class="error"> <?php echo $error?></div> 
					<a href="main.html"><input type="submit" name="submit" class="btn" value="Login"></a>
				</form>
			 </div>
		</div>
	  <script type="text/javascript" src="js/login.js" >
   </body>
</html>