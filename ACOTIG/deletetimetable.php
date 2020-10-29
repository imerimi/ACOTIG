<html>
<head></head>
<body>
<?php 

	$host="localhost";
	$user="root";
	$password="";
	$db="acotig";
	
	$conn= mysql_connect($host,$user,$password);
	mysql_select_db($db);
	
	$result = mysql_query('TRUNCATE TABLE result'); //remove all records from result table
header('Location:timetable.php');

?>
</body>
</html>