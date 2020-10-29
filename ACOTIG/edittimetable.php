<?php

	$host="localhost";
	$user="root";
	$password="";
	$db="acotig";
	
	mysql_connect($host,$user,$password);
	mysql_select_db($db);
	
	$type = $_GET['type'];
	$id = $_GET['id'];
	 
	
	if($type=="time"){
		$atime= $_POST['atime'];
		echo $atime;
		mysql_query("update result set timeslot='$atime' where id='$id' ");
		$message = "Redirect to Timetabler.";
		echo "<script type='text/javascript'>alert('$message'); window.location.href='timetable.php' </script>";
		
	}
	else if ($type=="room"){
		$aroom= $_POST['aroom'];
		echo $aroom;
		mysql_query("update result set room_fk='$aroom' where id='$id' ");
		$message = "Redirect to Timetabler.";
		echo "<script type='text/javascript'>alert('$message'); window.location.href='timetable.php' </script>";
	}
	
?>