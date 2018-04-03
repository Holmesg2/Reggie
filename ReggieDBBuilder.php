<?php
require_once('config.php');
//Create db
//SEMESTERS : FreshmanFall=0 FreshmanSpring=1 ,Sophomorefall=2, SophomoreSpring=3, JuniorFall=4, 
//JuniorSummer=5,SeniorSpring=6,SeniorSummer=7
//Priority should match above, as well as semester taken in progress field.
$conn = new mysqli($servername, $username, $password);
if($conn->connect_error) {
	die("Connection failed: " .$conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS reggiedb";
if($conn->query($sql)=== TRUE) {
	echo "Database created Successfully<br/>";
}else {
	echo "Error creating database: " .$conn->error;
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Student ID autogenerated in system.
// sql to create table
$sql_student = "CREATE TABLE IF NOT EXISTS student (
userID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
trackingID VARCHAR(8) NOT NULL,
year INTEGER(1) NOT NULL,
email VARCHAR(50) NOT NULL,
password CHAR(32)
)";  

if ($conn->query($sql_student) === TRUE) {
    echo "Table students created successfully<br/>";
} else {
    echo "Error creating student table: " . $conn->error."<br/>";
}
//Tracking sheet ID should be formatted like BCOS1415 for Bachelor of Comp-sci 2014-2015
$sql_progress = "CREATE TABLE IF NOT EXISTS progress (
trackingID VARCHAR(8) NOT NULL,
userID INT(6) UNSIGNED NOT NULL,
reqID VARCHAR(8),
courseID VARCHAR(8),
passed CHAR(1),
priority INT(2) UNSIGNED NOT NULL,
semtaken INT(2) UNSIGNED NOT NULL

)";

if ($conn->query($sql_progress) === TRUE) {
    echo "Table progress created successfully<br/>";
} else {
    echo "Error creating progress table: " . $conn->error."<br/>";
}

$sql_tracking = "CREATE TABLE IF NOT EXISTS TrackingSheet (
trackingID VARCHAR(8) PRIMARY KEY,
major VARCHAR (20),
year VARCHAR (9)
)";

if ($conn->query($sql_tracking) === TRUE) {
    echo "Table trackingSheet created successfully<br/>";
} else {
    echo "Error creating tracking table: " . $conn->error."<br/>";
}

$sql_semester ="CREATE TABLE IF NOT EXISTS semester (
trackingID VARCHAR(8),
reqID1 VARCHAR(8),
reqID2 VARCHAR(8),
reqID3 VARCHAR(8),
reqID4 VARCHAR(8),
semesterOrder INT(2) UNSIGNED NOT NULL
)";
if ($conn->query($sql_semester) === TRUE) {
    echo "Table semester created successfully<br/>";
} else {
    echo "Error creating semester table: " . $conn->error."<br/>";
}
//reqID format HUMN####, use course ID if requirement is a course, otherwise use ELEC for last 4 (HUMNELEC)
$sql_req = "CREATE TABLE IF NOT EXISTS requirement (
reqID VARCHAR(8) PRIMARY KEY NOT NULL,
requirement VARCHAR(20)
)";
if ($conn->query($sql_req) === TRUE) {
    echo "Table requirement created successfully<br/>";
} else {
    echo "Error creating requirement table: " . $conn->error."<br/>";
}
//courseID COMP#### etc. just like in lconnect
$sql_course = "CREATE TABLE IF NOT EXISTS course (
CourseID VARCHAR(8) PRIMARY KEY,
preReq VARCHAR(20),
tags VARCHAR(20),
courseName VARCHAR(30)
)";
if ($conn->query($sql_course) === TRUE) {
    echo "Table course created successfully<br/>";
} else {
    echo "Error creating Course table: " . $conn->error."<br/>";
}
//need to check how many numbers in a CRN but you get the idea
//DAYS MTWRF(Mon,Tues,Wed,Thurs,Fri
$sql_section = "CREATE TABLE IF NOT EXISTS section (
CRN VARCHAR (12) PRIMARY KEY,
courseID VARCHAR(8),
professor VARCHAR(36),
location VARCHAR(12),
days VARCHAR(5),
time TIME,
timeEnd TIME,
capacity INT(3) UNSIGNED,
taken INT(3) UNSIGNED
)";
if ($conn->query($sql_section) === TRUE) {
    echo "Table section created successfully<br/>";
} else {
    echo "Error creating section table: " . $conn->error."<br/>";
}
$sqlinTrack = "INSERT IGNORE INTO TrackingSheet (trackingID, major, year) VALUES ('COMP1415', 'Computer Science', '2014-2015')";
            if ($conn->multi_query($sqlinTrack) === TRUE) 
            {
                echo "New records created successfully - TrackingSheet<br/>";
            } 
            else
            {
                echo "Error: " . $sqlinTrack . "<br>" . $conn->error;
            }
  
$sqlinReq = "INSERT IGNORE INTO requirement(reqID, requirement) VALUES ('SCIELEC','scielec'), ('HUMNELEC', 'humnnelec'), ('COMPELEC', 'compelec')";
            if ($conn->multi_query($sqlinReq) === TRUE) 
            {
                echo "New records created successfully - Req<br/>";
            } 
            else
            {
                echo "Error: " . $sqlinReq . "<br>" . $conn->error;
            }
  
$sqlinCourse = "INSERT IGNORE INTO course(courseID, courseName, preReq, tags) VALUES ('COMP128', 'Computer Science 1', '', ''), ('COMP105', 'Introduction to Networking and Systems', '', ''),
('ENGL100', 'English 1', '',''), ('Math285', 'Engineering Calculus 1', '', ''), ('COMP201', 'Computer Science 2', 'COMP128', ''), ('ENGL130', 'English II', 'ENGL100',''), 
('MATH295', 'Engineering Calculus II', 'MATH285', ''), ('PHYS1', 'Physics I', '', 'scielec'), ('CHEM1', 'Chemistry I', '', 'scielec'), ('BIO1', 'Biology I', '','scielec'),
('COMP278', 'Computer Architecture', 'COMP201', ''),('COMP285', 'Object Oriented Programming', 'COMP201', ''),  ('HUMN0001', 'Technical WRiting', '','humnnelec'), ('HUMN0002', 'Media Ethics', '', 'humnnelec'), ('HUMN0003','Museums of Boston', '', 'humnelec'),
('HUMN0004', 'Contemporary Art and Theory', '', 'humnelec'), ('HUMN0005', 'American Dream', '', 'humnelec'), ('HUMN0006', 'Intro to Psychology', '' ,'humnelec'),
('HUMN0007', 'Criminology', '', 'humnelec'), ('HUMN0008', 'Sociology', '','humnelec'), ('PHYS2','Physics II', 'PHYS1', 'scielec'), ('CHEM2', 'Chemistry II', 'CHEM1', 'scielec'), ('BIO2', 'Biology II', 'BIO1', 'scielec'),
('COMP310', 'Data Structures', 'COMP285', ''), ('COMP355', 'Database Management', 'COMP285', ''), ('MATH410', 'Discrete Mathematics', 'MATH295', ''), ('COMP438', 'Assembly Language', 'COMP285', ''),
('COMP501', 'Introduction to Programming Languages', 'COMP285', ''), ('MATH440', 'Linear and Vector Algebra', 'MATH410', ''), ('COMP362', 'Operating Systems', 'COMP128',''),
('COMP414', 'Algorithm Design and Analysis', 'COMP128', ''), ('MATH505', 'Probability and Statistics for Engineers', 'MATH440', ''), ('COMP600', 'Artificial Intelligence', 'COMP128', 'compelec'),
('COMP601', 'Parallel Computing', 'COMP128', 'compelec'), ('COMP602', 'Intro to Biostatistics', 'COMP128', 'compelec'), ('COMP603', 'Web Development', 'COMP128', 'compelec'),
('COMP604', 'Mobile App Development', 'COMP128', 'compelec'), ('COMP566', 'Software Engineering', 'COMP128', ''), ('COMP655', 'Senior Project in BCOS', '',''), ('PHIL450', 'Ethics', '','')";
            if ($conn->multi_query($sqlinCourse) === TRUE) 
            {
                echo "New records created successfully - course<br/>";
            } 
            else
            {
                echo "Error: " . $sqlinCourse . "<br>" . $conn->error;
            }
$sqlinSemester = "INSERT IGNORE INTO semester(trackingID, reqID1, reqID2, reqID3, reqID4, semesterOrder) VALUES ('COMP1415', 'COMP128','COMP105','ENGL100','MATH285','0'), ('COMP1415', 'COMP201','ENGL130','MATH295','SCIELEC','1'),
('COMP1415', 'COMP278','COMP285','HUMNELEC','SCIELEC','2'),('COMP1415', 'COMP310','COMP355','MATH410','HUMNELEC','3'),('COMP1415', 'COMP438','COMP501','MATH440','HUMNELEC','4'),('COMP1415', 'COMP362','COMP414','MATH505','SCIELEC','5'),('COMP1415', 'COMP566','COMPELEC','COMPELEC','HUMNELEC','6'),('COMP1415', 'COMP655','COMPELEC','COMPELEC','PHIL450','7')";
		if($conn->multi_query($sqlinSemester)===TRUE)
		{
			echo "New records created successfully - semester<br/>";
		}
		else{
			echo"Error: " . $sqlinSemester ."<br>".$conn->error;
		}

$conn->close();
?>