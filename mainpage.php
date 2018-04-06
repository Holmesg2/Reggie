<?php

session_start();
//If session variable is not set it will redirect to login page
if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
    header("location: login-account-create/sign_in.html");
    exit;
} 

require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);

?>

<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald" />
		<LINK href="ReggieSty.css" rel="stylesheet" type="text/css">
		<title>Reggie</title>
		<link rel="icon" href="login-account-create/reggie.png">
	</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<div class="container" id="primaryWindow">
<?php

echo "<div id=top><div id='top-left'>"."Logged in as:" . htmlspecialchars($_SESSION["email"])."</div>";
echo "<form class='form-classes' method='POST' action='logout.php'><button id='top-right' type='submit' class='btn btn-default'>Log out</button></form></div>";

$queryUID = "SELECT userID FROM student WHERE email= '".$_SESSION["email"]."'";
$UIDQ = mysqli_query($conn,$queryUID);
if (!$UIDQ) {
    echo "Error getting UID: ", mysqli_error($conn);
    exit;
}
$UID=mysqli_fetch_array($UIDQ);
?>
	<div class="row" id="nav">
		<nav class="navbar navbar-light bg-light">
			<div class="col navb">
				<button class="btn-block btn-primary1" onclick="schedule()" type="button">Schedule</button>
			</div>
			<div class="col navb">
				
				<button class="btn-block btn-primary2" onclick="browseCourses()" type="button">Browse Courses</button>
			</div>
			<div class="col navb">
				
				<button class="btn-block btn-primary3" onclick="audit()" type="button">Audit</button>
			</div>
		</nav>
	</div>
	<div id="Course">
	<div class="row" >
		<h1 id="sem">
		</h1>
	</div>

	<div class="row carouselHeader">
		<div class="col topper-l" id="courseLabel">
			<label>Course Names</label>
		</div>
		<div class="col topper-r" id="courseLabel">
			<label>Course Info</label>
		</div>
	</div>
	<div class="container-fluid wrapper">
	<div class="row">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="false" data-interval="false">
			<ol class="carousel-indicators" id="indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
				<?php
				$query = "SELECT * from semester";
			$result = mysqli_query($conn,$query);
			$allCourses = array();
			while ($row = mysqli_fetch_array($result)){
				$allCourses[] = $row['reqID1'];
				$allCourses[] = $row['reqID2'];
				$allCourses[] = $row['reqID3'];
				$allCourses[] = $row['reqID4'];
			}
				?>
			</ol>
			<div class="carousel-inner">	
				<div class='carousel-item' value="-1">
						<div class='requirements inside' style='overflow:scroll; overflow-x: hidden;'>
							<div class='col navb'>
			<?php
			$seminfo= "";
			$sql = "SELECT * from section";
			$resSections = mysqli_query($conn,$sql);
			while ($rows = mysqli_fetch_array($resSections)) {
				$seminfo.=$rows['CRN'].$rows['courseID'].$rows['professor'].$rows['location'].$rows['days'].$rows['time'].$rows['timeEnd'].$rows['capacity'];
			}
			$completedCourseCount=0;
			$query = "SELECT * from progress";
			$result = mysqli_query($conn,$query);
						
						while ($row = mysqli_fetch_array($result)) {
							$completedCourseCount++;
							echo "	<div class='row' style='height:20%;'>
										<button class='btn-block btn-primary btn-course$completedCourseCount' onclick=\"updateSeminfo(1,'$seminfo')\" type='button'>".$row['courseID']."</button>
									</div>";
						}?>
							</div>
						</div>
							<div class='info inside'>
								<div id='semesterHead' name='seminfo1'>
									hey
								</div>
							</div>
					</div>
			<?php
			//PRINTING OUT SEMESTERS WITH 4 CLASSES 
			
			//for ($i=0;$i<count($allCourses);$i++){
			//			echo "$allCourses[$i]<br>";
			//}
			$query = "SELECT * from progress";
			$result = mysqli_query($conn,$query);
			$progCourses = array();
			while ($row2 = mysqli_fetch_array($result)){
				$progCourses[] = $row2['reqID'];
			}
			
			//for ($i=0;$i<count($progCourses);$i++){
			//			echo "$progCourses[$i]<br>";
			//}
			$coursesSoFar = array();
			$finalCourses = array();
			for ($i=0;$i<count($allCourses);$i++){
				for ($j=0;$j<count($progCourses);$j++){
					if ($allCourses[$i] == $progCourses[$j]){
						$coursesSoFar[]=$allCourses[$i];
						
						$progCourses[$j]='done';
						
						$allCourses[$i]='donetoo';
						break;
					}
				}
			}
			 
			$allCourses = array_merge(array_diff($allCourses, array('donetoo')));
			$activeCount=0;
			$saveIndex=0;
			$indinum=9;
			for ($i=0;$i<(count($allCourses)/4);$i++) {
				$activeCount++;
				$activeStr=" active";
				if ($activeCount > 1){
					$activeStr="";
				}
				echo "<div class='carousel-item $activeStr' value='$i'>
					<div class='requirements inside'>
						<div class='col navb'>";
							for ($j=0;$j<4;$j++){
								$num=$j+$saveIndex;
								if ($num >= count($allCourses)){
									break;
								}
								else{
									echo "<div class='row courses'>
										<button class='btn-block btn-primary btn-course".($completedCourseCount+$activeCount)."' type='button'>".$allCourses[($j+$saveIndex)]."</button>
									</div>";
								}
							}
							$saveIndex+=4;
				echo	"</div>
					</div>
					<div class='info inside'>
						<div id='semesterHead' name='seminfo".($i+2)."'>
							hey
						</div>
					</div>
				</div>";
				if($activeCount >1){
				echo "<script type='text/javascript'>updateIndicators($indinum);
				function updateIndicators(num){
					var newnode = document.createElement('LI');
					newnode.setAttribute('data-target','#carouselExampleIndicators');
					newnode.setAttribute('onclick','updateSemester()');
					newnode.id='indicators$i';
					newnode.setAttribute('data-slide-to','".($i+1)."');

					document.getElementById('indicators').appendChild(newnode);
				}</script>";
				}
				
				$indinum--;
			}
			?>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" onclick="updateSemester()" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" onclick="updateSemester()" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	</div>
	</div>
	<div id="Schedule" style="display:none">
			<table align="center">
			<tr>
				<th>Reggie!</th>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thursday</th>
				<th>Friday</th>
			</tr>
			<tr>
				<td>8:00 - 9:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>9:00 - 10:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>10:00 - 11:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>11:00 - 12:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>12:00 - 1:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>1:00 - 2:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>2:00 - 3:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>3:00 - 4:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>4:00 - 5:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>5:00 - 6:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>6:00 - 7:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>7:00 - 8:00</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</div>
			<div id="Audit" style="display:none">
		<div class="row">
			<div class="col">
			

				<div class="auditText">
					<p>Courses Completed List</p>
				</div>
					<table align="center">
					<tr>
						<th>Requirement</th>
						<th>CourseID</th>

					</tr>
					<?php
						$queryxx = "SELECT * FROM progress WHERE userID=".$UID['userID']."";
						$resultxx = mysqli_query($conn,$queryxx);
						$coursesPassed = 0;
							while($rowxx=mysqli_fetch_array($resultxx)){
								$coursesPassed=$coursesPassed+1;
//								if($rowxx['semtaken'] == 0){
//									$semesterName = "Freshman Fall";
//								}else if($rowxx['semtaken'] == 1){
//									$semesterName = "Freshman Spring";
//								}else if($rowxx['semtaken'] == 2){
//									$semesterName = "Sophomore Fall";
//								}elseif($rowxx['semtaken'] == 3){
//									$semesterName = "Sophomore Spring";
//								}else if($rowxx['semtaken'] == 4){
//									$semesterName = "Junior Fall";
//								}else if($rowxx['semtaken'] == 5){
//									$semesterName = "Junior Summer";
//								}else if($rowxx['semtaken'] == 6){
//									$semesterName = "Senior Spring";
//								}else if($rowxx['semtaken'] == 7){
//									$semesterName = "Senior Summer";
//								}
								echo" <tr>
								<td>".$rowxx['reqID']."</td>
								<td>".$rowxx['courseID']."</td>
								</tr>";
							}
							echo"</table><div class='row'>Courses Completed: ".$coursesPassed."</div>";
					?>
					<div class = "auditText">
						<p></br>Courses Remaining List</p>
					</div>
					<table align="center">
					<tr>
						<th>Requirement</th>
						<th>CourseID</th>
						<th>Course Name</th>
					</tr>
					<?php
						$queryx = "SELECT * FROM course WHERE reqID NOT IN(SELECT courseID FROM progress WHERE userID=".$UID['userID'].") GROUP BY reqID";
						$resultx=mysqli_query($conn,$queryx);
						$coursesRemaining=0;
						while($rowx=mysqli_fetch_array($resultx)){
							$coursesRemaining=$coursesRemaining+1;
								echo" <tr>
								<td>".$rowx['reqID']."</td>
								<td>".$rowx['CourseID']."</td>
								<td>".$rowx['courseName']."</td>
								</tr>";
							}
							echo"</table><div class='row'>Courses Remaining: ".$coursesRemaining."</div>";
					?>
			</div>
		</div>
	</div>
</div>
<script src="mainpage.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
</body>
