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
		<a href="main.php"><i class="fa fa-arrow-left"></i></a></div>
		<h1 class="title">TIMETABLER</h1>
	</header>
	<main>
	<div class="button">
	<form method="post" action="generatetimetable.php">
		<button class="add" name="submit">Generate Timetable</button> <!--Generate Timetable-->
	</form>
	<form method="post" action="deletetimetable.php">
		<button class="add" name="submit">Delete Timetable</button> <!--Generate Timetable-->
	</form>
	<button class="add" onclick="showDiv()" name="groupby" >View Timetable by Value</button> <!--View Timetable by Value-->
	<button class="add" onclick="showDiv1()" name="submit">Edit Timetable</button>  <!--Edit Timetable-->
	</div>
	
	
	<form method="post" action="timetablebyvalue.php">
	<div id="groupby" style="display:none" >
	<br/><p>Category: <select name="groupby" id="groupby1">
					  <option value="blank">Select..</option>
					  <option value="lecturer">Lecturer</option>
					  <option value="room">Room</option>
					  <option value="group">Group</option>
					  <option value="subject">Subject</option></select></p><br/>
	</div>
	
	<div id="showlecturer"  style="display:none;">
		<?php	$sql = "SELECT id FROM lecturer";
				$result = mysql_query($sql);

				echo "Lecturer: <select name='name'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['id'] ."'>" . $row['id'] ."</option>";
				}
				echo "</select>";?>
				<button class="add" name="submit">OK</button>
	</div>
	<div id="showroom"  style="display:none;">
		<?php	$sql = "SELECT code FROM room";
				$result = mysql_query($sql);

				echo "Room Code: <select name='code'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['code'] ."'>" . $row['code'] ."</option>";
				}
				echo "</select>";?>
				<button class="add" name="submit">OK</button>
	</div>
	<div id="showgroup"  style="display:none;">
		<?php	$sql = "SELECT id FROM grouping";
				$result = mysql_query($sql);

				echo "Group: <select name='id'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['id'] ."'>" . $row['id'] ."</option>";
				}
				echo "</select>";?>
				<button class="add" name="submit">OK</button>
	</div>
	<div id="showsubject"  style="display:none;">
		<?php	$sql = "SELECT code FROM subject";
				$result = mysql_query($sql);

				echo "Subject Code: <select name='scode'>";
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" . $row['code'] ."'>" . $row['code'] ."</option>";
				}
				echo "</select>";?>
				<button class="add" name="submit">OK</button>
	</div>
	</form>
	
	
	<form method="post" action="checkavailable.php">
	<div id="type" style="display:none">
	
	<br/><p>		ID: <select name="num" id="num" >
			<option value='blank'>Select..</option>
	<?php	$sql = "SELECT id FROM result group by id";
				$result = mysql_query($sql);
				while ($row = mysql_fetch_array($result)) {
					echo "<option value='" , $row['id'] ,"'>" , $row['id'] ,"</option>";
				}
				echo "</select>";
				?></p><br/>
					  
			<p>Type: <select name="groupby" id="type1">
					  <option value="blank">Select..</option>
					  <option value="room">room</option>
					  <option value="time">time</option>
					  </select>
			<button class="add" name="submit">OK</button></p><br/>
	</div>
	</form>
	
	
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
				}
				else{
					echo "<tr><td colspan='7'>No results available.</td></tr>";
				}	
					echo "</table>";
			?>
	</div>
	</main>
	</body>
	<script>
	var select = document.getElementById("groupby1");
	select.onchange=function(){
		if(select.value=="lecturer"){
		   document.getElementById("showlecturer").style.display="inline";
		   document.getElementById("showroom").style.display="none";
		   document.getElementById("showgroup").style.display="none";
		   document.getElementById("showsubject").style.display="none";
		}
		else if(select.value=="room"){
		   document.getElementById("showroom").style.display="inline";
		   document.getElementById("showlecturer").style.display="none";
		   document.getElementById("showgroup").style.display="none";
		   document.getElementById("showsubject").style.display="none";
		}
		else if(select.value=="group"){
			document.getElementById("showgroup").style.display="inline";
			document.getElementById("showroom").style.display="none";
			document.getElementById("showlecturer").style.display="none";
			document.getElementById("showsubject").style.display="none";
		}
		else if(select.value=="subject"){
			document.getElementById("showsubject").style.display="inline";
			document.getElementById("showroom").style.display="none";
			document.getElementById("showgroup").style.display="none";
			document.getElementById("showlecturer").style.display="none";
		}
	}
		
	function showDiv(){
		document.getElementById("groupby").style.display = 'inline';
		}
	
	function showDiv1(){
		document.getElementById("type").style.display = 'inline';
		}
	</script>
</html>