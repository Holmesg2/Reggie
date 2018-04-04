<?php
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

$email = $_POST['email'];
$pass = $_POST['pass'];

//header("Location:sign_in.html"); //redirect to main page after submit 

$error = mysqli_connect_error();
	if($error != null){
		$output = "<p>unable to connect to database</p>".$error;
		exit($output);
	}else{
		$getEmail = "SELECT email from student where email='".$email."'";
		$emailRes = mysqli_query($conn,$getEmail);
		
		$getPass = "SELECT password from student where email''".$email."'";
		$passRes = mysqli_query($conn,$getPass);
		
		/* echo "<script type='text/javascript'>alert('".$emailRes."');
			window.location.href='sign_in.html';</script>"; */

		if(mysqli_num_rows($emailRes) == 1){ //if email exists
			$storedPass = "SELECT password from student where email='".$email."'";
			$getStored = mysqli_query($conn,$storedPass);
			
			if(mysqli_fetch_object($getStored,[password]) == mysqli_fetch_object($passRes,[password])){ //check for matching password
				header("Location:reggie/mainpage.html");
			}
			else{
			// $message = "Incorrect login info, try again.";  
			// echo "<script type='text/javascript'>alert('$message');
			// window.location.href='sign_in.html';</script>";
			}
		}
		else{
			// $message = "Incorrect login info, try again.";  
			// echo "<script type='text/javascript'>alert('$message');
			// window.location.href='sign_in.html';</script>";
		}
	}
	
?>