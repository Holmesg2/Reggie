var y = document.getElementById("Course");
var x = document.getElementById("Schedule");
var z = document.getElementById("Audit");


window.onload=updateSemester();

function schedule(){
	$('.btn-primary1').css('background-color', '#bbecc6');
	$('.btn-primary2').css('background-color', 'white');
	$('.btn-primary3').css('background-color', 'white');
	y.style.display="none";
	z.style.display="none";
	x.style.display="block";

	
}
function browseCourses(){
	$('.btn-primary1').css('background-color', 'white');
	$('.btn-primary2').css('background-color', '#bbecc6');
	$('.btn-primary3').css('background-color', 'white');
	y.style.display="block";
	z.style.display="none";
	x.style.display="none";
;
}
function audit(){
	$('.btn-primary1').css('background-color', 'white');
	$('.btn-primary2').css('background-color', 'white');
	$('.btn-primary3').css('background-color', '#bbecc6');
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

function updateSeminfoComp(i,seminfo,name){
	var sem=document.getElementsByName("seminfo"+i);
	sem[0].innerHTML = name;
}
function updateSeminfo(i,seminfo,name, scheduleTimes){
	//alert(scheduleTimes+"js");
	var sem=document.getElementsByName("seminfo"+i);
	sem[0].innerHTML = name;
	var inside=document.getElementsByName("inside"+i);
	
	while (inside[0].firstChild) {
		inside[0].removeChild(inside[0].firstChild);
	}
	var curClasses = document.getElementsByName("curClassInfo");
	//for (i =0; i<curClasses.length;i++){
	//	inside[0].removeChild(curClasses[i]);
	//}

	var times=scheduleTimes.split(",");
	//alert("times"+times[0]);
	var sections = seminfo.split("_");
	for (i =0; i<sections.length-1;i++){
		var sectionInfo = sections[i].split("|");
		var dummy = document.getElementById("dummyframe");
		inSchedule=0;
		var div=document.createElement("div");
		startTime=sectionInfo[5];
		//alert("startTime"+startTime);
		for(j=0;j<times.length;j++){
			//alert(startTime);
				if(times[j]==startTime){
					inSchedule=1;
				}
		}
		if (inSchedule==1){
			div.setAttribute("style","background-color:red");
		}
		div.setAttribute("name", "curClassInfo");
		div.style.borderBottom="thick solid black";
		div.innerHTML="CRN:"+sectionInfo[0]+"	"+sectionInfo[1]+"	"+sectionInfo[2]+"	"+sectionInfo[3]+"	"+sectionInfo[4]+"	"+sectionInfo[5]+"\n"+sectionInfo[6]+"\n"+sectionInfo[7];
		
		//INSERT INTO schedule"+num+" "
		var numInput=document.createElement("input");
		numInput.setAttribute("value",sectionInfo[0]);
		numInput.setAttribute("name","number");
		numInput.setAttribute("style","display:none");
		
		
		var numForm=document.createElement("form");
		numForm.setAttribute("method","post");
		numForm.setAttribute("action","insertSchedule.php");
		
		
		var addButton=document.createElement("button");
		if (inSchedule==1){
			addButton.setAttribute('disabled','disabled');
		}
		addButton.setAttribute("class","btn-block");
		addButton.setAttribute("type","submit");
		addButton.setAttribute("value","submit");
		
		var buttonText=document.createElement("span");
		buttonText.setAttribute("class","class='glyphicon glyphicon-play-circle");
		buttonText.innerHTML="Add Course To Schedule";
		
		numForm.appendChild(numInput);
		addButton.appendChild(buttonText);
		numForm.appendChild(addButton);
		div.appendChild(numForm);
		
		inside[0].appendChild(div);
	}
}



function colorBtn(completed, position){
	if(completed<position){
		var temp;
		temp = position - completed;
		temp = temp % 4;
		var head = position-temp;
		var toChange1 = '.btn-course'+head.toString();
		var toChange2 = '.btn-course'+(head+1).toString();
		var toChange3 = '.btn-course'+(head+2).toString();
		var toChange4 = '.btn-course'+(head+3).toString();
		var toSelected = '.btn-course'+(position).toString();
		$(toChange1).css('background-color', 'white');
		$(toChange2).css('background-color', 'white');
		$(toChange3).css('background-color', 'white');
		$(toChange4).css('background-color', 'white');
		$(toSelected).css('background-color','#bbecc6');
	}
	else{
		for(var i=0; i<completed; i++){
			$('.btn-course'+i.toString()).css('background-color', 'white');
		}
		$('.btn-course'+position.toString()).css('background-color','#bbecc6');
	}
}




