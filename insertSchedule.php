<?php
session_start();
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

$num=$_POST['number'];
$queryUID = "SELECT userID FROM student WHERE email= '".$_SESSION["email"]."'";
$UIDQ = mysqli_query($conn,$queryUID);
if (!$UIDQ) {
    echo "Error getting UID: ", mysqli_error($conn);
    exit;
}
$UID=mysqli_fetch_array($UIDQ);
$query = "INSERT INTO schedule (userID,CRN) VALUES ('".$UID['userID']."','".$num."')";
$result = mysqli_query($conn,$query);

$query = "UPDATE section SET taken = taken + 1 WHERE CRN=".$num."";
$result = mysqli_query($conn,$query);
header("location:mainpage.php");
?>