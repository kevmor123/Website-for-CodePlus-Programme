$(document).ready(function() {
$("#submit1").click(function() {
var name = $("#name").val();
var email = $("#email").val();
var job = $("#job").val();
var school = $("#school").val();
var description = $("#description").val();
var homeAddress= $("#homeAddress").val();
var user_id= $("#userid").val();
// Returns successful data submission message when the entered information is stored in database.
$.post("refreshform.php", {
name1: name,
email1: email,
job1: job,
school1: school,
description1: description,
homeAddress1: homeAddress,
user_id1:user_id
}, function(data) {
	alert(data);

});

});


});