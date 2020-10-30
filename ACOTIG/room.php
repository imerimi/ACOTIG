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
	 
   </head>
   	<body>		
   <header>
		<div class="back_button">
		<a href="main.php"><i class="fa fa-arrow-left"></i></a></div>
		<h1 class="title">ROOM</h1>
	</header>
	<main>
	<div class="add">
		<h1 style="text-align:left">Add New Record</h1>
		<form method="post" action="add.php?type=room&">
		  Code:<input type="text" name="code" autocomplete="off">
		 
		<?php	$sql = "SELECT name FROM roomtype";
				$result = mysql_query($sql);

				echo "Room Type: <select name='name'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
				}
				echo "</select>";?>

		  <button id="add" name="submit">Add</button>
		</form> 
	</div>
	<br><br>
	<div class="table">
		<h1>View/ Delete Existing Records</h1>
		<table>
			<tr>
				<th>No</th>
				<th>Code</th>
				<th>Room Type</th>
				<th>Capacity</th>
				<th>Action</th>
			</tr>
			
			<?php $sql ="SELECT r.code, r.roomtype_fk, rt.capacity from room r join roomtype rt on r.roomtype_fk=rt.name";
				$result=mysql_query($sql);
				$type="room";
				$no= 1;
				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_assoc($result)){
						echo "<tr><td>".$no++."</td><td>".$row['code']."</td><td>".$row['roomtype_fk']."</td><td>".$row['capacity']."<td><a href='delete.php?id=".$row['code']."&type=".$type."'  onclick=\"return confirm('Are you sure?')\"><i class='fa fa-close'></a></td></tr>";
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
