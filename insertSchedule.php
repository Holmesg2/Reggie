<?php
session_start();
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

$num=$_POST['number'];

$query = "INSERT INTO schedule (userID,CRN) VALUES ('".$UID['userID']."','".$num."')";
$result = mysqli_query($conn,$query);
echo $result;

$query = "UPDATE section SET taken = taken + 1";
$result = mysqli_query($conn,$query);
header("location:mainpage.php");
?>