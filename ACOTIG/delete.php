<?php

	$type = $_GET['type'];
	
	$host="localhost";
	$user="root";
	$password="";
	$db="acotig";
	
	mysql_connect($host,$user,$password);
	mysql_select_db($db);

	if ($type=="room"){
		$code = $_GET['id'];
		$result=mysql_query("SELECT count(*) as total from result WHERE room_fk='$code'");
		$data=mysql_fetch_assoc($result);
		if ($data['total']>0){
			$total= $data['total'];
			$message = "The room is associated with $total records in Result table.Please make sure that the room is not in use before deleting this record.";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='timetable.php' </script>";
		}
		else{
			mysql_query("DELETE from room WHERE code='$code'");
			$message = "Records had been deleted";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='room.php' </script>";
		}
	}
	
	if ($type=="lecturer"){
		$id = $_GET['id'];
		
		$result=mysql_query("SELECT count(*) as total from class WHERE lecturer_fk='$id'");
		$data=mysql_fetch_assoc($result);
		if ($data['total']>0){
			$total= $data['total'];
			$message = "The lecturer is associated with $total records in Class table.Please proceed to remove class related with the lecturer before deleting this records.";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='class.php' </script>";
		}
		else{
			mysql_query("DELETE from lecturer WHERE id='$id'");
			$message = "Records had been deleted";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='lecturer.php' </script>";
		}
	}
	
	if ($type=="group"){
		$id = $_GET['id'];
		
		$result=mysql_query("SELECT count(*) as total from class WHERE grouping_fk='$id'");
		$data=mysql_fetch_assoc($result);
		if ($data['total']>0){
			$total= $data['total'];
			$message = "The group is associated with $total records in Class table.Please proceed to remove class related with the group before deleting this records.";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='class.php' </script>";
		}
		else{
			mysql_query("DELETE from grouping WHERE id='$id'");
			$message = "Records had been deleted";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='group.php' </script>";
		}
	}
	
	if ($type=="subject"){
		$code = $_GET['id'];
		
		$result=mysql_query("SELECT count(*) as total from class WHERE subject_fk='$code'");
		$data=mysql_fetch_assoc($result);
		if ($data['total']>0){
			$total= $data['total'];
			$message = "The subject is associated with $total records in Class table.Please proceed to remove class related with the subject before deleting this records.";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='subject.php' </script>";
		}
		else{
			mysql_query("DELETE from subject WHERE code='$code'");
			$message = "Records had been deleted";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='subject.php' </script>";
		}
	}
	
	if ($type=="class"){
		$id = $_GET['id'];
		
		$result=mysql_query("SELECT count(*) as total from result WHERE class_fk='$id'");
		$data=mysql_fetch_assoc($result);
		if ($data['total']>0){
			$total= $data['total'];
			$message = "The class is associated with $total records in Result table.You may delete the timetable before deleting this record.";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='timetable.php' </script>";
		}
		else{
			mysql_query("DELETE from class WHERE id='$id'");
			$message = "Records had been deleted";
			echo "<script type='text/javascript'>alert('$message'); window.location.href='class.php' </script>";
		}
	}
?>