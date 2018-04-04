<?php
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<html>
	<head>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<LINK href="ReggieSty.css" rel="stylesheet" type="text/css">
	</head>
<body style='overflow:auto'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<div class="container" id="primaryWindow">
	<div class="row" id="nav">
		<nav class="navbar navbar-light bg-light">
			<div class="col navb">
				<button class="btn-block" onclick="schedule()" type="button">Schedule</button>
			</div>
			<div class="col navb">
				
				<button class="btn-block" onclick="browseCourses()" type="button">Browse Courses</button>
			</div>
			<div class="col navb">
				
				<button class="btn-block" onclick="audit()" type="button">Audit</button>
			</div>
		</nav>
	</div>
	<div class="row" >
		<h1 id="sem">
		</h1>
	</div>
	<div id="Course">
	<div class="row">
		<div class="col topper-l">Course Names
		</div>
		<div class="col topper-r" id="">
			Course Info
		</div>
	</div>
	<div class="container-fluid wrapper">
	<div class="row">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="false" data-interval="false">
			<ol class="carousel-indicators">
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
				for ($i=2;$i<((count($allCourses)/4)-3);$i++){
					echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
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
			$res = mysqli_query($conn,$sql);
			while ($rows = mysqli_fetch_array($result)) {
				$seminfo+=$rows['CRN']+$rows['courseID']+$rows['professor']+$rows['location']+$rows['days']+$rows['time']+$rows['timeEnd']+$rows['capacity'];
			}
			$seminfo ="asdf";
			
			$query = "SELECT * from progress";
			$result = mysqli_query($conn,$query);
						
						while ($row = mysqli_fetch_array($result)) {
							
							echo "	<div class='row' style='height:20%;'>
										<button class='btn-block' onclick='updateSeminfo(1,'$seminfo')' type='button'>".$row['courseID']."</button>
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
								if ($allCourses[($num)] == null){
									break;
								}
								else{
									echo "<div class='row courses'>
										<button class='btn-block' type='button'>".$allCourses[($j+$saveIndex)]."</button>
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
			<table>
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
				<td>&nbsp;</td>
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
					<p>Courses Completed</p>
				</div>
					<table>
					<tr>
						<th>Requirement</th>
						<th>CourseID</th>
						<th>SemesterTaken</th>
					</tr>
					<?php
						$queryxx = "SELECT * from progress";
						$resultxx = mysqli_query($conn,$queryxx);
						$coursesPassed = 0;
							while($rowxx=mysqli_fetch_array($resultxx)){
								$coursesPassed=$coursesPassed+1;
								echo" <tr>
								<td>".$rowxx['reqID']."</td>
								<td>".$rowxx['courseID']."</td>
								<td>".$rowxx['semtaken']."</td>
								</tr>";
							}
							echo"</table><div class='row'>Courses Completed: ".$coursesPassed."</div>";
					?>
					<div class = "auditText">
						<p></br>Courses Remaining List</p>
					</div>
					<table>
					<tr>
						<th>Requirement</th>
						<th>CourseID</th>
						<th>Course Name</th>
					</tr>
					<?php
						$queryx = "SELECT * FROM course WHERE reqID NOT IN(SELECT courseID FROM progress) GROUP BY reqID";
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
