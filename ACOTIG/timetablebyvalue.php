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
      <link rel="stylesheet" type="text/css" href="timetable.css"/>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src=" "></script>
   </head>
   	<body>		
   <header>
		<div class="back_button">
		<a href="timetable.php"><i class="fa fa-arrow-left"></i></a></div>
		<h1 class="title">TIMETABLE BY VALUE</h1>
	</header>
	<main>
	
	
	<div class="table">
		<table>
			<tr>
				<th> </th>
				<th>0900-1100</th>
				<th>1100-1300</th>
				<th>1300-1400</th>
				<th>1400-1600</th>
				<th>1600-1800</th>
			</tr>
			<?php 
				$category=$_POST['groupby'];
				if ($category=="lecturer"){
					$value=$_POST['name'];
					echo "<div class='summary'>$category: $value</div>";
					$sql ="SELECT c.subject_fk, c.section, rs.room_fk,c.lecturer_fk,c.grouping_fk, timeslot from result rs join class c on rs.class_fk=c.id where c.lecturer_fk='$value'";
				}
				else if ($category=="room"){
					$value=$_POST['code'];
					echo "<div class='summary'>$category: $value</div>";
					$sql ="SELECT c.subject_fk, c.section, rs.room_fk,c.lecturer_fk,c.grouping_fk, timeslot from result rs join class c on rs.class_fk=c.id where rs.room_fk='$value'";
				}
				else if  ($category=="group"){
					$value=$_POST['id'];
					echo "<div class='summary'>$category: $value</div>";
					$sql ="SELECT c.subject_fk, c.section, rs.room_fk,c.lecturer_fk,c.grouping_fk, timeslot from result rs join class c on rs.class_fk=c.id where c.grouping_fk='$value'";
				}
				else if  ($category=="subject"){
					$value=$_POST['scode'];
					echo "<div class='summary'>$category: $value</div>";
					$sql ="SELECT c.subject_fk, c.section, rs.room_fk,c.lecturer_fk,c.grouping_fk, timeslot from result rs join class c on rs.class_fk=c.id where c.subject_fk='$value'";
				}
				$nineData = ["","","","",""]; 
				$elevenData = ["","","","",""]; 
				$twoData = ["","","","",""];
				$fourData = ["","","","",""];
				$result=mysql_query($sql);
				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_assoc($result)){
						if($row['timeslot']=="MON9-11"){
							$nineData[0]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="TUE9-11"){
							$nineData[1]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="WED9-11"){
							$nineData[2]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="THU9-11"){
							$nineData[3]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="FRI9-11"){
							$nineData[4]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="MON11-1"){
							$elevenData[0]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="TUE11-1"){
							$elevenData[1]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="WED11-1"){
							$elevenData[2]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="THU11-1"){
							$elevenData[3]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="FRI11-1"){
							$elevenData[4]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="MON2-4"){
							$twoData[0]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="TUE2-4"){
							$twoData[1]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="WED2-4"){
							$twoData[2]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="THU2-4"){
							$twoData[3]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="FRI2-4"){
							$twoData[4]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="MON4-6"){
							$fourData[0]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="TUE4-6"){
							$fourData[1]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="WED4-6"){
							$fourData[2]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="THU4-6"){
							$fourData[3]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
						if($row['timeslot']=="FRI4-6"){
							$fourData[4]="'".$row['subject_fk']."'-'".$row['section']."'<br>'".$row['room_fk']."'<br>'".$row['lecturer_fk']."'<br>'".$row['grouping_fk']."'";
						}
					}
				}
				
				for($i=0;$i<5;$i++){
				$day = array("Mon", "Tue", "Wed","Thu","Fri");
				echo "<tr><td>$day[$i]</td><td>$nineData[$i]</td><td>$elevenData[$i]</td><td><td>$twoData[$i]</td><td>$fourData[$i]</td></tr>";
			}
			?>
		</table>
	</div>
	</main>
	</body>
</html>