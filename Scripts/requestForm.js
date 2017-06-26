$(document).ready(function() {
$("#submitSchool").click(function() {
var teacherName = $("#teacherName").val();
var schoolName = $("#schoolName").val();
var schoolEmail = $("#schoolEmail").val();
var schoolAddress = $("#schoolAddress").val();
var numberStudents = $("#numberStudents").val();
var date3 =	$("#requestedDate").val();
var requestid =	$("#requestedid").val();
var message = $('textarea#message').val();

// Returns to the home page when a successful request is made
$.post("requestForm.php", {
teacherName1: teacherName,
schoolName1: schoolName,
schoolEmail1: schoolEmail,
schoolAddress1: schoolAddress,
numberStudents1: numberStudents,
date1:date3,
requestid1:requestid,
message1:message


}, function(data) {
	if(!data){
	 window.location.replace('index.php');
	}
	else{
	 document.write(data);
	}

});

});


});