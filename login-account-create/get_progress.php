<?php
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);
$db_table = "progress";

header("Location:../mainpage.html"); //redirect to main page after submit 

$error = mysqli_connect_error();
	if($error != null){
		$output = "<p>unable to connect to database</p>".$error;
		exit($output);
	}else{
		echo "Connect to DB successfully <br/>";
		//insert data
		if(isset($_POST['comp1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['comp1']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['network'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['network']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['eng1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['eng1']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}

		if(isset($_POST['calc1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['calc1']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['comp2'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['comp2']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['eng2'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['eng2']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['calc2'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['calc2']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['sci-elective1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['sci-elective1']."', 'y', '0', '0')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['arch'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['arch']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['oop'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['oop']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['hum/soc1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['hum/soc1']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['sci-elective2'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['sci-elective2']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['data'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['data']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['dbms'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['dbms']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['math1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['math1']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['hum/soc2'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['hum/soc2']."', 'y', '1', '1')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['assembly'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['assembly']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['prog-lang'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['prog-lang']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['math2'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['math2']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['hum/soc3'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['hum/soc3']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['os'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['os']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['math3'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['math4']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['math4'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['math4']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['science1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['science1']."', 'y', '2', '2')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['software-engineering'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['software-engineering']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['comp-elective1'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['comp-elective1']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['comp-elective2'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['comp-elective2']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['hum/soc4'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['hum/soc4']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['senior-proj'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['senior-proj']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['comp-elective3'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['comp-elective3']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['comp-elective4'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['comp-elective4']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
		
		if(isset($_POST['ethics'])){
			$sql = "INSERT INTO " .$db_table . " (trackingID,userID,reqID,courseID,passed,priority,semtaken)
			VALUES ('COMP1415','1', '1', '".$_POST['ethics']."', 'y', '3', '3')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
		}
	}
	mysqli_close($conn);
?>