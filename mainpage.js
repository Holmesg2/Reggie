var y = document.getElementById("Course");
var x = document.getElementById("Schedule");
var z = document.getElementById("Audit");

function schedule(){
	
	y.style.display="none";
	z.style.display="none";
	x.style.display="block";
}
function browseCourses(){
	y.style.display="block";
	z.style.display="none";
	x.style.display="none";
}
function audit(){
	y.style.display="none";
	z.style.display="block";
	x.style.display="none";
}