<?php
	$type = $_GET['type'];
		
		$host="localhost";
		$user="root";
		$password="";
		$db="acotig";
		
		$conn = mysqli_connect($host,$user,$password,$db);
		
		$error="";
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		if($type=="room"){		
			if (isset($_POST['submit'])){
				if(empty($_POST['code']) || empty($_POST['name'])){
					echo '<script type="text/javascript">'; 
					echo 'alert("Empty Input");'; 
					echo 'window.location.href = "room.php";';
					echo '</script>';
					
				}
				else{
					$roomtype=$_POST['name'];
					$code=$_POST['code'];
					
					
					$result=mysqli_query($conn,"SELECT * from room WHERE code='$code'");					
					if(mysqli_num_rows($result) >0 ){
						$message = "Code is duplicated!Please use another code.";
						echo "<script type='text/javascript'>alert('$message'); window.location.href='room.php' </script>";
					}
					else{
						$sql = "INSERT INTO room(code,roomtype_fk) VALUES('$code', '$roomtype')"; 
						$result = mysqli_query($conn, $sql);  
						if ($result) {
							$message = "New record added successfully";
							echo "<script type='text/javascript'>alert('$message'); window.location.href='room.php' </script>";
						} 
						else {
							 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}		
					}
					mysqli_close($conn);
				}
			}
		}
		
		
		if($type=="lecturer"){	
			if (isset($_POST['submit'])){
				if(empty($_POST['id']) || empty($_POST['name'])){
					echo '<script type="text/javascript">'; 
					echo 'alert("Empty Input");'; 
					echo 'window.location.href = "lecturer.php";';
					echo '</script>';
					
				}
				else{
					$id=$_POST['id'];
					$name=$_POST['name'];
					
					
					$result=mysqli_query($conn,"SELECT * from lecturer WHERE id='$id'");					
					if(mysqli_num_rows($result) >0 ){
						$message = "ID is duplicated!Please use another ID.";
						echo "<script type='text/javascript'>alert('$message'); window.location.href='lecturer.php' </script>";
					}
					else{
						$sql = "INSERT INTO lecturer(id,name) VALUES('$id', '$name')"; 
						$result = mysqli_query($conn, $sql);  
						if ($result) {
							$message = "New record added successfully";
							echo "<script type='text/javascript'>alert('$message'); window.location.href='lecturer.php' </script>";
						} 
						else {
							 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}		
					}
					mysqli_close($conn);
				}
			}
		}
		
		if($type=="group"){	
			if (isset($_POST['submit'])){
				if(empty($_POST['id']) || empty($_POST['desc'])){
					echo '<script type="text/javascript">'; 
					echo 'alert("Empty Input");'; 
					echo 'window.location.href = "group.php";';
					echo '</script>';
					
				}
				else{
					$id=$_POST['id'];
					$desc=$_POST['desc'];
					
					
					$result=mysqli_query($conn,"SELECT * from grouping WHERE id='$id'");					
					if(mysqli_num_rows($result) >0 ){
						$message = "ID is duplicated!Please use another ID.";
						echo "<script type='text/javascript'>alert('$message'); window.location.href='group.php' </script>";
					}
					else{
						$sql = "INSERT INTO grouping(id,description) VALUES('$id', '$desc')"; 
						$result = mysqli_query($conn, $sql);  
						if ($result) {
							$message = "New record added successfully";
							echo "<script type='text/javascript'>alert('$message'); window.location.href='group.php' </script>";
						} 
						else {
							 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}		
					}
					mysqli_close($conn);
				}
			}
		}
		
		
		if($type=="subject"){	
			// echo"correct";
			if (isset($_POST['submit'])){
				if(empty($_POST['code']) || empty($_POST['title'])){
					echo '<script type="text/javascript">'; 
					echo 'alert("Empty Input");'; 
					echo 'window.location.href = "subject.php";';
					echo '</script>';
					
				}
				else{
					$code=$_POST['code'];
					$title=$_POST['title'];
					
					
					$result=mysqli_query($conn,"SELECT * from subject WHERE code='$code'");					
					if(mysqli_num_rows($result) >0 ){
						$message = "Code is duplicated!Please use another Code.";
						echo "<script type='text/javascript'>alert('$message'); window.location.href='subject.php' </script>";
					}
					else{
						$sql = "INSERT INTO subject(code,title) VALUES('$code', '$title')"; 
						$result = mysqli_query($conn, $sql);  
						if ($result) {
							 $message = "New record added successfully";
							echo "<script type='text/javascript'>alert('$message'); window.location.href='subject.php' </script>";
						} 
						else {
							 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}		
					}
					mysqli_close($conn);
				}
			}
		}
		
		
		if($type=="class"){	
			// echo"correct";
			if (isset($_POST['submit'])){
				if(empty($_POST['subject_fk']) || empty($_POST['section']) || empty($_POST['roomtype_fk']) || empty($_POST['lecturer_fk']) || empty($_POST['grouping_fk'])){
					echo '<script type="text/javascript">'; 
					echo 'alert("Empty Input");'; 
					echo 'window.location.href = "class.php";';
					echo '</script>';
					
				}
				else{
					$subject=$_POST['subject_fk'];
					$section=$_POST['section'];
					$roomtype=$_POST['roomtype_fk'];
					$lecturer=$_POST['lecturer_fk'];
					$grouping=$_POST['grouping_fk'];
					
					
					$result=mysqli_query($conn,"SELECT * from class WHERE subject_fk='$subject' and section='$section'");					
					if(mysqli_num_rows($result) >0 ){
						$message = "Same subject and section existed.";
						echo "<script type='text/javascript'>alert('$message'); window.location.href='class.php' </script>";
					}
					else{
						$sql = "INSERT INTO class(section,subject_fk,roomtype_fk,lecturer_fk,grouping_fk) VALUES('$section', '$subject','$roomtype','$lecturer','$grouping')"; 
						$result = mysqli_query($conn, $sql);  
						if ($result) {
							  $message = "New record added successfully";
							echo "<script type='text/javascript'>alert('$message'); window.location.href='class.php' </script>";
						} 
						else {
							 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}		
					}
					mysqli_close($conn);
				}
			}
		}

?>