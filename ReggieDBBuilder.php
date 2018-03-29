<?php
$servername = "localhost";
$username = "username";
$password = "wit123";
$dbname = "ReggieDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql_student = "CREATE TABLE Student (
userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
trackingID VARCHAR(8) NOT NULL,
year INT(1) NOT NULL,
email VARCHAR(50) NOT NULL,
password CHAR(32),
FOREIGN KEY (trackingID)
)";  

if ($conn->query($sql_student) === TRUE) {
    echo "Table Students created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql_progress = "CREATE TABLE Progress (
trackingID VARCHAR(8) NOT NULL,
userID INT(6),
reqID VARCHAR(8) NOT NULL,
courseID VARCHAR(9),
passed TINYINT(1),
order INT(2),
semTaken INT(2)
FOREIGN KEY (trackingID),
FOREIGN KEY (userID)
)";

if ($conn->query($sql_progress) === TRUE) {
    echo "Table Progress created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql_tracking = "CREATE TABLE TrackingSheet (
trackingID VARCHAR(8) PRIMARY KEY,
major VARCHAR (20),
year VARCHAR (9)
)";
if ($conn->query($sql_tracking) === TRUE) {
    echo "Table trackingSheet created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$sql_semester ="CREATE TABLE semester (
trackingID VARCHAR(8),
req1ID VARCHAR(8),
req2ID VARCHAR(8),
req3ID VARCHAR(8),
req4ID VARCHAR(8),
semesterOrder INT(2)
)";
if ($conn->query($sql_semester) === TRUE) {
    echo "Table semester created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql_req = "CREATE TABLE req (
reqID VARCHAR(8) PRIMARY KEY,
requirement VARCHAR()
)";
if ($conn->query($sql_req) === TRUE) {
    echo "Table req created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql_course = "CREATE TABLE course (
CourseID VARCHAR(8) PRIMARY KEY,
preReq VARCHAR(),
tags VARCHAR()
)";
if ($conn->query($sql_course) === TRUE) {
    echo "Table course created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$sql_section = "CREATE TABLE section (
CRN VARCHAR (12) PRIMARY KEY,
courseID VARCHAR(8) FOREIGN KEY,
professor VARCHAR(36),
location VARCHAR(12),
time TIMESTAMP,
capacity INT(3),
taken INT(3)
)";
if ($conn->query($sql_section) === TRUE) {
    echo "Table section created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
?>