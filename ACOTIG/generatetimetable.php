<html>
<head></head>
<body>
<?php 
	
		$host="localhost";
		$user="root";
		$password="";
		$db="acotig";
		
		mysql_connect($host,$user,$password);
		mysql_select_db($db);
		
		$sql= "select id from grouping";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
			$group= $row['id']; 
			$result1=mysql_query("SELECT count(*) as total from class WHERE grouping_fk='$group'");
			$data=mysql_fetch_assoc($result1);
			$total= $data['total'];
			if ($total>20){
				$message = "$group contains of more than 20 records which exceed the number of available timslot. Kindly reduce it to <=20.";
				echo "<script type='text/javascript'>alert('$message'); window.location.href='class.php' </script>";
				$noclash ="no";
			}
			else{
				$noclash ="yes";
			}
		}
		if($noclash=="yes"){
			shell_exec("cd java/connect && javac -cp mysql-connector-java-8.0.19.jar;. DB.java && java -cp mysql-connector-java-8.0.19.jar;. DB");
			shell_exec("cd java && javac Driver.java && java Driver");
			header('Location:readResult.php');
		}

?>
</body>
</html>