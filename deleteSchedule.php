<?php
session_start();
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

$num=$_POST['number'];

$query = "DELETE FROM schedule WHERE CRN=".$num."";
$result = mysqli_query($conn,$query);

$query = "UPDATE section SET taken = taken - 1 WHERE CRN=".$num."";
$result = mysqli_query($conn,$query);

header("location:mainpage.php");
?>