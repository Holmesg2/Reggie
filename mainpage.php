<?php
require_once('config.php');

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<LINK href="ReggieSty.css" rel="stylesheet" type="text/css">
	</head>
<body>
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
	<div id="Course">
		<div class="row">
			<div class="col topper-l">Course Names
			</div>
			<div class="col topper-r">
				Course Info
			</div>
		</div>
		<div class="row container wrapper">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="false" data-interval="false">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<!--<img class="d-block w-100 active" src="..." alt="First slide">-->
						<div class="requirements inside">
							<div class="col navb">
							<div class="row courses">
								<button class="btn-block" type="button">COMP128</button>
							</div>
								<div class="row courses"><button class="btn-block" type="button">CALC I</button>
							</div>
							<div class="row courses">
								<button class="btn-block" type="button">ENGLISH I</button>
							</div>
							<div class="row courses">
								<button class="btn-block" type="button">INTRO TO NETWORKING</button>
							</div>
							</div>
						</div>
						<div class="info inside">
							hello
						</div>
					</div>
					<div class="carousel-item">
						gabba
					</div>
					<div class="carousel-item">
						gooba
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
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

				<p>Audit<br /></p>
				<div>
					<p>Overall<br /></p>
					<div>
						<p>Courses Completed List</p>
					</div>
					<div>
					<?php
						$queryxx = "SELECT * from progress";
						$resultxx = mysqli_query($conn,$queryxx);
						$coursesPassed = 0;
							while($rowxx=mysqli_fetch_array($resultxx)){
								$coursesPassed=$coursesPassed+1;
								echo" <div class='row'>".$rowxx['reqID']."</div>";
							}
							echo"<div class='row'>Courses Completed: ".$coursesPassed."</div>";
					?>
					</div>
					<div>
						<p></br>Courses Remaining List</p>
					</div>
					<?php
						$queryx = "SELECT * FROM course WHERE reqID NOT IN(SELECT reqID FROM progress) GROUP BY reqID";
						$resultx=mysqli_query($conn,$queryx);
						$coursesRemaining=0;
						while($rowx=mysqli_fetch_array($resultx)){
							$coursesRemaining=$coursesRemaining+1;
							echo"<div class='row'>".$rowx['reqID']."</div>";
						}
						echo "<div class='row'>Courses Remaining: ".$coursesRemaining."</div>";
					?>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../Reggie/mainpage.js"></script>;
</body>
