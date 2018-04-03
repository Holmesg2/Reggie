<?php
require_once('config.php');


$conn = mysqli_connect($servername, $username, $password, $dbname);
$db_table = "student";

$email = $_POST['email'];
$pass = $_POST['pass'];
$school = $_POST['school'];
$tracking = $_POST['tracking-sheet'];
$track = $_POST['track'];

//header("Location:sign_in.html"); //redirect to main page after submit 

$error = mysqli_connect_error();
	if($error != null){
		$output = "<p>unable to connect to database</p>".$error;
		exit($output);
	}else{
		//insert data
		$query = "SELECT email from student where email='".$email."'";
		$result = mysqli_query($conn,$query);

		if(mysqli_num_rows($result) == 0) //a user with that email doesnt exist
		{
			$sql = "INSERT INTO " .$db_table. " (trackingID,year,email,password)
			Values ('".$tracking."','2014','".$email."','".$pass."')";
			if(mysqli_query($conn,$sql)){
				echo"New record created successfully <br/>";
			}else{
				echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
			}
			
			if($track == 'yes'){
				header("Location:choose_classes.html"); //redirect to choose classes
			}
			else{
				header("Location:mainpage.html"); //redirect to main page after submit 
			}
		}
		else{
			$message = "An account with this email address already exists!";  //this doesnt work???
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='/Reggie-master/login-account-create/Create_account.html';</script>";
		}
	}
mysqli_close($conn);

?>
