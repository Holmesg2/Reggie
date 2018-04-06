var y = document.getElementById("Course");
var x = document.getElementById("Schedule");
var z = document.getElementById("Audit");
var ybtn=document.getElementById("courseBtn");
var xbtn=document.getElementById("scheduleBtn");
var zbtn=document.getElementById("auditBtn");

window.onload=updateSemester();

function schedule(){
	$('.btn-primary1').css('background-color', '#009100');
	$('.btn-primary2').css('background-color', 'white');
	$('.btn-primary3').css('background-color', 'white');
	y.style.display="none";
	z.style.display="none";
	x.style.display="block";

	
}
function browseCourses(){
	$('.btn-primary1').css('background-color', 'white');
	$('.btn-primary2').css('background-color', '#009100');
	$('.btn-primary3').css('background-color', 'white');
	y.style.display="block";
	z.style.display="none";
	x.style.display="none";
;
}
function audit(){
	$('.btn-primary1').css('background-color', 'white');
	$('.btn-primary2').css('background-color', 'white');
	$('.btn-primary3').css('background-color', '#009100');
	y.style.display="none";
	z.style.display="block";
	x.style.display="none";

}


function updateSemester(){
	setTimeout(function(){
		var sem=document.getElementById("sem");
		var val = $(".carousel-item.active").attr('value');
		if (val == -1){	
			sem.innerHTML = 'Completed Courses';
		}
		else{
			val++;
			sem.innerHTML = 'Semester #' + val;
		}
    }, 670);
}

function updateSeminfo(i,seminfo){
	var sem=document.getElementsByName("seminfo"+i);
	alert(sem[0]);
	sem[0].innerHTML = seminfo;
}
