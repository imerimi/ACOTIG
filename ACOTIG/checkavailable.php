<?php

	$host="localhost";
	$user="root";
	$password="";
	$db="acotig";
	
	mysql_connect($host,$user,$password);
	mysql_select_db($db);
	
	$id= $_POST['num'];
	$type= $_POST['groupby'];
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
      <link rel="stylesheet" type="text/css" href="timetable.css"/>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src=" "></script>
   </head>
   	<body>		
   <header>
		<div class="back_button">
		<a href="timetable.php"><i class="fa fa-arrow-left"></i></a></div>
		<h1 class="title">EDIT TIMETABLE</h1>
	</header>
	<main>
	
<?php

	echo "<form method='post' action='edittimetable.php?type=$type&id=$id'>";
	echo "<div class='summary'>ID: $id</div>";
	echo "<div class='summary'>Category: $type</div>";

	
	if($type=="room"){
		
		$sql= "select c.roomtype_fk from class c join result rs on c.id=rs.class_fk where rs.id='$id'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$roomtype= $row['roomtype_fk']; 
		}

		$sql= "select timeslot from result where id='$id'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$timeslot= $row['timeslot']; 
		}

		
		$code = array();
		$sql= "select r.code, rs.timeslot from room r join result rs on r.code=rs.room_fk where timeslot='$timeslot' and r.roomtype_fk='$roomtype'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$code[]= $row['code']; 

		}
		
		echo "<div class='summary'> Available Room: <select name='aroom' id='aroom' > </div>";
		$sql= "select code from room where roomtype_fk='$roomtype'";
		$result = mysql_query($sql);
		$noavailable= 0;
		while($row = mysql_fetch_array($result)) {
			if (in_array($row['code'], $code)) {

			}
			else{
				echo "<option value= '".$row['code']."'> ".$row['code']." </option>";
				$noavailable++;
			}
		}
		echo "</select>";
		if($noavailable==0){
			echo "Sorry, no available room. Click ok or back button to go back to Timetabler.";
		}
				echo '<button class="add" name="submit">OK</button>';
			
	}
	
	
	
	if($type=="time"){
		$sql= "select room_fk from result where id='$id'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$room= $row['room_fk']; 
		}
		$sql= "select timeslot from result where id='$id'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$timeslot= $row['timeslot']; 
		}

		
		$timeslot = array();
		$sql= "select timeslot from result where room_fk='$room'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$timeslot[]= $row['timeslot']; 
		}
		
		$alltime = array("MON9-11","TUE9-11","WED9-11","THU9-11","FRI9-11","MON11-1","TUE11-1","WED11-1",
		"THU11-1","FRI11-1","MON2-4","TUE2-4","WED2-4","THU2-4","FRI2-4","MON4-6","TUE4-6","WED4-6","THU4-6","FRI4-6"); 
		
		
		$roomtime= array();
		
		
		$sql= "select c.lecturer_fk from class c join result rs on rs.class_fk=c.id where rs.id='$id'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			 $lec= $row['lecturer_fk']; 
		}

		$sql= "select c.grouping_fk from class c join result rs on rs.class_fk=c.id where rs.id='$id'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			 $group= $row['grouping_fk']; 
		}
		
		
		$sql= "select rs.timeslot from result rs join class c on rs.class_fk=c.id where c.lecturer_fk='$lec'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$timeslot[]= $row['timeslot']; 
	
		}
		
		
		$sql= "select rs.timeslot from result rs join class c on rs.class_fk=c.id where c.grouping_fk='$group'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$timeslot[]= $row['timeslot']; 
		}
		
		$size = count($alltime);
		echo "<div class='summary'> Available Timeslot: <select name='atime' id='atime' ></div>";
		$noavailable= 0;
		for($i=0;$i<$size;$i++){
			if(in_array($alltime[$i], $timeslot)){
				
			}
			else{
				echo "<option value=$alltime[$i]> $alltime[$i]</option>";
				$noavailable++;
			}
		}
		echo "</select>";
		if($noavailable==0){
			echo "Sorry, no available room. Click ok or back button to go back to Timetabler.";
		}
		echo '<button class="add" name="submit">OK</button>';
	}
	echo "</form>"
?>
	<div class="table">
		<table>
			<tr>
				<th>ID</th>
				<th>Subject Code</th>
				<th>Section</th>
				<th>Room</th>
				<th>Lecturer</th>
				<th>Grouping</th>
				<th>Time</th>
			</tr>
			<?php $sql ="SELECT rs.id, c.subject_fk, c.section, rs.room_fk,c.lecturer_fk,c.grouping_fk, timeslot from result rs join class c on rs.class_fk=c.id ";
				$result=mysql_query($sql);
				$type="class";
				$no= 1;
				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_assoc($result)){
						echo "<tr><td>".$row['id']."</td><td>".$row['subject_fk']."</td><td>".$row['section']."</td><td>".$row['room_fk']."</td><td>".$row['lecturer_fk']."</td><td>".$row['grouping_fk']."</td><td>".$row['timeslot']."</td></tr>";
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