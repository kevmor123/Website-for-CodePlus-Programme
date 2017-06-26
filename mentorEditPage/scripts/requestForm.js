$(document).ready(function() {
$("#submitSchool").click(function() {
var teacherName = $("#teacherName").val();
var schoolName = $("#schoolName").val();
var schoolEmail = $("#schoolEmail").val();
var schoolAddress = $("#schoolAddress").val();
var numberStudents = $("#numberStudents").val();
var date3 =	$("#requestedDate").val();

// Returns successful data submission message when the entered information is stored in database.
$.post("requestForm.php", {
teacherName1: teacherName,
schoolName1: schoolName,
schoolEmail1: schoolEmail,
schoolAddress1: schoolAddress,
numberStudents1: numberStudents,
date1:date3


}, function(data) {
	alert(data);

});

});


});