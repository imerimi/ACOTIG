<?php 
	session_start();
	
	$host="localhost";
	$user="root";
	$password="";
	$db="acotig";
	
	mysql_connect($host,$user,$password);
	mysql_select_db($db);
?>

<!DOCTYPE html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ACOTIG-Automated College Timetable Generator</title>
	  <link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="reset.css"/>
      <link rel="stylesheet" type="text/css" href="resources.css"/>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src=" "></script>
   </head>
   	<body>		
   <header>
		<div class="back_button">
		<a href="main.php"><i class="fa fa-arrow-left"></i></a></div>
		<h1 class="title">LECTURER</h1>
	</header>
	<main>
	<div class="add">
		<h1 style="text-align:left">Add New Record</h1>
		<form method="post" action="add.php?type=lecturer&">
		  ID:<input type="text" name="id" autocomplete="off">
		  Name:<input type="text" name="name" autocomplete="off">
		  <button id="add" name="submit">Add</button>
		</form> 
	</div>
	<br><br>
	<div class="table">
		<h1>View/ Delete Existing Records</h1>
		<table>
			<tr>
				<th>No</th>
				<th>ID</th>
				<th>Name</th>
				<th>Action</th>
			</tr>
			<?php $sql ="SELECT id,name from lecturer";
				$result=mysql_query($sql);
				$no= 1;
				$type="lecturer";
				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_assoc($result)){
						echo "<tr><td>".$no++."</td><td>".$row['id']."</td><td>".$row['name']."<td><a href='delete.php?id=".$row['id']."&type=".$type."'  onclick=\"return confirm('Are you sure?')\"><i class='fa fa-close'></a></td></tr>";
					}
					echo "</table>";
				}
				else{
					echo "no results available.";
				}		
			?>
	</div>
	</main>
	</body>
</html>
