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

echo "<div class='row' id=top><div class='col-4' id='top-left'>"."Logged in as:" . htmlspecialchars($_SESSION["email"])."</div>";
echo "<div class='col-6' id='topTitle'>Reggie!</div>";
echo "<form class='form-classes col-2' method='POST' action='logout.php'><button id='top-right' type='submit' class='btn-block btn-primary'>Log out</button></form></div>";

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
				<li data-target="#carouselExampleIndicators" onclick="updateSemester()" data-slide-to="0"></li>
				<li data-target="#carouselExampleIndicators" onclick="updateSemester()" data-slide-to="1" class="active"></li>
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
			$sql = "SELECT * from section";
			$resSections = mysqli_query($conn,$sql);
			$completedCourseCount=0;
			$query = "SELECT * from progress";
			$result = mysqli_query($conn,$query);
			$progArray = array();
			$sectionArray = array();
			while ($row = mysqli_fetch_array($result)){
				$progArray[] = $row;
			}
			while ($rows = mysqli_fetch_array($resSections)) {
				$sectionArray[]=$rows;
			}
			
			//grabbing courses to grab the course Name by CourseID
			$courseQuery = "SELECT * from course";
			$courseResult = mysqli_query($conn,$courseQuery);
			$courseNameArray=array();
			while ($courseRows = mysqli_fetch_array($courseResult)) {
				$courseNameArray[]=$courseRows;
			}
			
						
						foreach ($progArray as $row){
							$seminfo= "";
							$fullName="";
							foreach($sectionArray as $rows) {
								#echo"<script>alert('".$rows['courseID'].$row['courseID']."');</script>";

								if($rows['courseID']==$row['courseID']){
									foreach($courseNameArray as $courseName){
										if ($courseName['CourseID'] == $row['courseID']){
											$fullName = $courseName['courseName'];
										}
									}
									#echo"<script>alert('".$rows['courseID'].$row['courseID']."');</script>";
									$seminfo.=$rows['CRN']."|".$rows['courseID']."|".$rows['professor']."|".$rows['location']."|".$rows['days']."|".$rows['time']."|".$rows['timeEnd']."|".$rows['capacity'];
									$seminfo.="_";
								}
							}
							$completedCourseCount++;
							echo "	<div class='row' style='height:20%;'>
										<button class='btn-block btn-primary btn-course$completedCourseCount' onclick=\"updateSeminfoComp(1,'$seminfo','$fullName')\" type='button'>".$row['courseID']."</button>
									</div>";
						}?>
							</div>
						</div>
								<div id='semesterHead' name='seminfo1'>
								</div>
							<div class='info inside' name="inside1">This Course has been completed.<br><br>

							Grade: N/A
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
								$seminfo="";
								$num=$j+$saveIndex;
								$CourseIDafter2 = $allCourses[($j+$saveIndex)];
								foreach($courseNameArray as $courseName){
									foreach($sectionArray as $rows) {
										if ($courseName['CourseID'] == $CourseIDafter2){
											$fullName2 = $courseName['courseName'];
										}
									}
								}
								$query ="SELECT * FROM course WHERE reqID LIKE '%ELEC%'";
								$result =mysqli_query($conn,$query);
								$reqIDarr = array();
								while ($row = mysqli_fetch_array($result)){
									$reqIDarr[]=$row;
								}
								$checker=0;
								foreach ($reqIDarr as $req){
									if ($allCourses[$j+$saveIndex] == $req['reqID']){
										$checker=1;
										foreach($sectionArray as $section){
											if ($req['CourseID']==$section['courseID']){
												$seminfo.=$section['CRN']."|".$section['courseID']."|".$section['professor']."|".$section['location']."|".$section['days']."|".$section['time']."|".$section['timeEnd']."|".$section['capacity'];
												$seminfo.="_";
											}
										}
										if ($num >= count($allCourses)){
											break;
										}
									}
								}
								#echo "<script>alert('".$CourseIDafter2."');</script>";
								$queryz = "SELECT * from section WHERE courseID='".$CourseIDafter2."'";
								$resultz = mysqli_query($conn,$queryz);
								while ($row2 = mysqli_fetch_array($resultz)){
									if ($checker==1){
										$checker=0;
										break;
									}
									$seminfo.=$row2['CRN']."|".$row2['courseID']."|".$row2['professor']."|".$row2['location']."|".$row2['days']."|".$row2['time']."|".$row2['timeEnd']."|".$row2['capacity'];
									$seminfo.="_";
								}
								if ($num >= count($allCourses)){
									break;
								}
								else{
									echo "<div class='row courses'>
										<button class='btn-block btn-primary btn-course".($completedCourseCount+$activeCount)."' onclick=\"updateSeminfo(".($i+2).",'$seminfo','$fullName2')\" type='button'>".$CourseIDafter2."</button>
									</div>";
								}
							}
							$saveIndex+=4;
				echo	"</div>
					</div>
					<div id='semesterHead' name='seminfo".($i+2)."'>
					</div>
					<div class='info inside' name='inside".($i+2)."'>	
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
	</div><iframe width="0" height="0" border="0" name="dummyframe" style="display: none;" id="dummyframe"></iframe>
	
	<div id="Schedule" style="display:none">
			<table align="center">
			<tr>
				<th>Reggie!</th>
				<th id="M">Monday</th>
				<th id="T">Tuesday</th>
				<th id="W">Wednesday</th>
				<th id="R">Thursday</th>
				<th id="F">Friday</th>
			</tr>
			<tr id="08:00:00">
				<td >8:00 - 9:00</td>
				<td id="08:00:00M">&nbsp;</td>
				<td id="08:00:00T">&nbsp;</td>
				<td id="08:00:00W">&nbsp;</td>
				<td id="08:00:00R">&nbsp;</td>
				<td id="08:00:00F">&nbsp;</td>
			</tr>
			<tr id="09:00:00">
				<td>9:00 - 10:00</td>
				<td id="09:00:00M">&nbsp;</td>
				<td id="09:00:00T">&nbsp;</td>
				<td id="09:00:00W">&nbsp;</td>
				<td id="09:00:00R">&nbsp;</td>
				<td id="09:00:00F">&nbsp;</td>
			</tr>
			<tr id="10:00:00">
				<td>10:00 - 11:00</td>
				<td id="10:00:00M">&nbsp;</td>
				<td id="10:00:00T">&nbsp;</td>
				<td id="10:00:00W">&nbsp;</td>
				<td id="10:00:00R">&nbsp;</td>
				<td id="10:00:00F">&nbsp;</td>
			</tr>
			<tr id="11:00:00">
				<td>11:00 - 12:00</td>
				<td id="11:00:00M">&nbsp;</td>
				<td id="11:00:00T">&nbsp;</td>
				<td id="11:00:00W">&nbsp;</td>
				<td id="11:00:00R">&nbsp;</td>
				<td id="11:00:00F">&nbsp;</td>
			</tr>
			<tr id="12:00:00">
				<td>12:00 - 1:00</td>
				<td id="12:00:00M">&nbsp;</td>
				<td id="12:00:00T">&nbsp;</td>
				<td id="12:00:00W">&nbsp;</td>
				<td id="12:00:00R">&nbsp;</td>
				<td id="12:00:00F">&nbsp;</td>
			</tr>
			<tr id="01:00:00">
				<td>1:00 - 2:00</td>
				<td id="01:00:00M">&nbsp;</td>
				<td id="01:00:00T">&nbsp;</td>
				<td id="01:00:00W">&nbsp;</td>
				<td id="01:00:00R">&nbsp;</td>
				<td id="01:00:00F">&nbsp;</td>
			</tr>
			<tr id="02:00:00">
				<td>2:00 - 3:00</td>
				<td id="02:00:00M">&nbsp;</td>
				<td id="02:00:00T">&nbsp;</td>
				<td id="02:00:00W">&nbsp;</td>
				<td id="02:00:00R">&nbsp;</td>
				<td id="02:00:00F">&nbsp;</td>
			</tr>
			<tr id="03:00:00">
				<td>3:00 - 4:00</td>
				<td id="03:00:00M">&nbsp;</td>
				<td id="03:00:00T">&nbsp;</td>
				<td id="03:00:00W">&nbsp;</td>
				<td id="03:00:00R">&nbsp;</td>
				<td id="03:00:00F">&nbsp;</td>
			</tr>
			<tr id="04:00:00">
				<td>4:00 - 5:00</td>
				<td id="04:00:00M">&nbsp;</td>
				<td id="04:00:00T">&nbsp;</td>
				<td id="04:00:00W">&nbsp;</td>
				<td id="04:00:00R">&nbsp;</td>
				<td id="04:00:00F">&nbsp;</td>
			</tr>
			<tr id="05:00:00">
				<td>5:00 - 6:00</td>
				<td id="05:00:00M">&nbsp;</td>
				<td id="05:00:00T">&nbsp;</td>
				<td id="05:00:00W">&nbsp;</td>
				<td id="05:00:00R">&nbsp;</td>
				<td id="05:00:00F">&nbsp;</td>
			</tr>
			<tr id="06:00:00">
				<td>6:00 - 7:00</td>
				<td id="06:00:00M">&nbsp;</td>
				<td id="06:00:00T">&nbsp;</td>
				<td id="06:00:00W">&nbsp;</td>
				<td id="06:00:00R">&nbsp;</td>
				<td id="06:00:00F">&nbsp;</td>
			</tr>
			<tr id="07:00:00">
				<td>7:00 - 8:00</td>
				<td id="07:00:00M">&nbsp;</td>
				<td id="07:00:00T">&nbsp;</td>
				<td id="07:00:00W">&nbsp;</td>
				<td id="07:00:00R">&nbsp;</td>
				<td id="07:00:00F">&nbsp;</td>
			</tr>
		</table>
		
	<?php
	$sql = "SELECT * from section WHERE userID=".$UID['userID']."";
	$CRNRes = mysqli_query($conn,$sql);	
	$CRN = array();
	while ($rows = mysqli_fetch_array($CRNRes)) {
		$CRN[] = $rows['CRN1'];
		$CRN[] = $rows['CRN2'];
		$CRN[] = $rows['CRN3'];
		$CRN[] = $rows['CRN4'];
		$CRN[] = $rows['CRN5'];
	}
	//every timeslot
	$timesArr = array("08:00:00", "09:00:00", "10:00:00", "11:00:00", "12:00:00", "01:00:00", "02:00:00", "03:00:00", "04:00:00", "05:00:00", "06:00:00", "07:00:00");
	$daysArr = array("M","T","W","R","F");
	$sql = "SELECT * from section";
	$scheduleRes = mysqli_query($conn,$sql);
	while ($rows = mysqli_fetch_array($scheduleRes)) {
		foreach($CRN as $crn){
			if ($crn == $rows['CRN']){
				$days=array();
				$days=explode(',',$rows['days']);
				echo "<script>alert('".$days[0]."');</script>";
				$start=$rows['time'];
				$end=$rows['timeEnd'];
				foreach($days as $day) {
					foreach($timesArr as $timeslot){
						foreach ($daysArr as $days) {
							if ($start == $timeslot  && $days == $day){
								
								$prof=$rows['professor'];
								$loc=$rows['location'];
								$taken=$rows['taken'];
								$REM=$rows['capacity'];
								$courseIDSchedule=$rows['courseID'];
								echo "
								<script>
								alert('".$rows['courseID']."');
								scheduleHTML='".$courseIDSchedule."\\nCRN:".$crn."\\n".$prof."\\n".$loc."\\nAct:".$taken."\\nRem:".$REM."';
								cell=document.getElementById('".$timeslot.$day."');
								cell.innerHTML=scheduleHTML;
								</script>
								";
							}
						}
					}
				}
			}
		}
	}
	?>
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
