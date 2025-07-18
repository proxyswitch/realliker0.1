// JavaScript Document
$(document).ready(function(){
$(".login,.register").validate();	
$(document).on("submit",".register",function(e){
e.preventDefault();	
if($(".register").valid()){
$.ajax({
url: "request/register.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==2){
$(".register")[0].reset();	
$(".regalert").html("Your account has been created Successfully! <a href='index'>Please Click here to login</a>");	
}
else{
$(".regalert").html("Email Exists please try with new email");
}
}
});	
}
});


/*$(document).on("submit",".login",function(e){
e.preventDefault();	
if($(".login").valid()){
$.ajax({
url: "request/login.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==3){
$(".logalert").html("We Can't find your username or email please register with us");	
}
else if(msg==2) {
$(".logalert").html("Please check your password");
}
else if(msg==1) {
window.location="smme-dashboard.php";
}
else {
$(".logalert").html("We Can't find your username or email please register with us");	
}
}
});	
}
});*/

$(document).on("submit",".forgetpass",function(e){
e.preventDefault();	
if($(".forgetpass").valid()){
$.ajax({
url: "request/resetpassword.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==2) {
$(".forgetpass")[0].reset();	
	
$(".fogalert").html("We have sent mail for reseting password!");
}
else {
$(".fogalert").html("We Can't find your username or email please register with us");	
}	

}
});	
}
	
});



$(document).on("submit",".contactus",function(e){
e.preventDefault();	
if($(".contactus").valid()){
$.ajax({
url: "request/contactus.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
$(".alert").html("We will get back to u soon.")	
}
});
}
});

$(document).on("submit",".ordertrack",function(e){
e.preventDefault();	
if($(".ordertrack").valid()){
$.ajax({
url: "request/trackorder.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
$(".ordertrack")[0].reset();	
$(".trackalert").html(msg);
}
});	
}
});
});