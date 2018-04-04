<?php
session_start();
$_SESSION["email"] = $_POST['email'];

// If session variable is not set it will redirect to login page
if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    header("location: sign_in.html");
    exit;
} 
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

$email = $_POST['email'];
$pass = $_POST['pass'];




$error = mysqli_connect_error();
	if($error != null){
		$output = "<p>unable to connect to database</p>".$error;
		exit($output);
	}else{
		$getEmail = "SELECT email from student where email='".$email."'";
		$emailRes = mysqli_query($conn,$getEmail);
		  
		
		if(mysqli_num_rows($emailRes) == 1){ //if email exists
			$storedPass = "SELECT password from student where email='".$email."'";
			$getStored = mysqli_query($conn,$storedPass);
			$passArr2 = mysqli_fetch_row($getStored);
			
			if($pass == $passArr2[0]){ //check for matching password
				header("Location:../mainpage.html");
			}
			else{
			$message = "Incorrect login info, try again.";  
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='sign_in.html';</script>";
			}
		}
		else{
			$message = "Incorrect login info, try again.";  
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='sign_in.html';</script>";
		}
	}
	
?>