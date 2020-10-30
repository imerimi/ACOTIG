<?php	
	$host="localhost";
	$user="root";
	$password="";
	$db="acotig";
	
	$conn= mysql_connect($host,$user,$password);
	mysql_select_db($db);
	
	$result = mysql_query('TRUNCATE TABLE result'); //remove all records from result table
	
	
	$file = fopen("result.txt","r");  // Open the txt file for reading
	
	 while(! feof($file))  {
        $group = fgets($file);
        $subject =fgets($file);
	    $section = fgets($file);
		$room = fgets($file);
		$timeslot = fgets($file);
		
		$group=preg_replace('/\s+/', '', $group);
		$subject =preg_replace('/\s+/', '', $subject);
	    $section = preg_replace('/\s+/', '', $section);
		$room = preg_replace('/\s+/', '', $room);
		$timeslot = preg_replace('/\s+/', '', $timeslot);
		

		$result=mysql_query("SELECT id from class where section='$section' and subject_fk='$subject'");
		$data=mysql_fetch_assoc($result);
		$classid= $data['id'];
		echo "<br>";
		
		$sql = "INSERT INTO result (id,timeslot,class_fk,room_fk)VALUES(NULL,'$timeslot', '$classid','$room')";
		mysql_query($sql);		
	
   }
	fclose($file);
	header('Location:timetable.php');
?>