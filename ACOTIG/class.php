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
      <link rel="stylesheet" type="text/css" href="class.css"/>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src=" "></script>
   </head>
   	<body>		
   <header>
		<div class="back_button">
		<a href="main.php"><i class="fa fa-arrow-left"></i></a></div>
		<h1 class="title">CLASS</h1>
	</header>
	<main>
	<div class="add">
		<h1 style="text-align:left">Add New Record</h1>
		<form method="post" action="add.php?type=class&">
			<?php	$sql = "SELECT code FROM subject";
				$result = mysql_query($sql);

				echo "Subject Code: <select name='subject_fk'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['code'] ."'>" . $row['code'] ."</option>";
				}
				echo "</select>";?>
		  Section:<input type="text" name="section">
		  <?php	$sql = "SELECT name FROM roomtype";
				$result = mysql_query($sql);

				echo "Room Type: <select name='roomtype_fk'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
				}
				echo "</select>";?>
		 <?php	$sql = "SELECT id FROM lecturer";
				$result = mysql_query($sql);

				echo "Lecturer: <select name='lecturer_fk'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['id'] ."'>" . $row['id'] ."</option>";
				}
				echo "</select>";?>
		 <?php	$sql = "SELECT id FROM grouping";
				$result = mysql_query($sql);

				echo "Grouping: <select name='grouping_fk'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['id'] ."'>" . $row['id'] ."</option>";
				}
				echo "</select>";?>

		  <button id="add" name="submit">Add</button>
		</form> 
	</div>
	</form>
	<div class="table">
		<table>
			<tr>
				<th>No</th>
				<th>Subject Code</th>
				<th>Section</th>
				<th>Room Type</th>
				<th>Lecturer</th>
				<th>Grouping</th>
				<th>Action</th>
			</tr>
			<?php $sql ="SELECT id, subject_fk, section, roomtype_fk, lecturer_fk, grouping_fk from class";
				$result=mysql_query($sql);
				$type="class";
				$no= 1;
				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_assoc($result)){
						echo "<tr><td>".$no++."</td><td>".$row['subject_fk']."</td><td>".$row['section']."</td><td>".$row['roomtype_fk']."</td><td>".$row['lecturer_fk']."</td><td>".$row['grouping_fk']."<td><a href='delete.php?id=".$row['id']."&type=".$type."'  onclick=\"return confirm('Are you sure?')\"><i class='fa fa-close'></a></td></tr>";
					}
				}
				else{
					echo "<tr><td colspan='7'>No results available.</td></tr>";
				}	
				echo "</table>";	
			?>
	</div>
	</main>
	</body>
</html>
