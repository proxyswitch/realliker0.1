$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/profile.php',
data:'process=getrecords&page='+$page+"&search="+$search,
success:function($msg){
$("#content").html($msg);
}
})
}
getrecords("",1);

$(document).on("click",'.pagination li.active',function(){
$search=$(this).attr('searchterms');
$page = $(this).attr('p');
getrecords($search,$page);
}); 

$(document).on("click","#refresh",function(){
$("#suser").val("");
$("#scord option:selected").val("");
getrecords("",1);
});


$(document).on("click",".create",function(){
$(".creategroup #newgroup").val("");
$(".creategroupbox").dialog({
title:"New Group"
});	
});

$(".addgroup").on("click",function(){
if($(".creategroup").valid()){
$groupname=$(".creategroup #newgroup").val();
$.ajax({
type:'post',
url:'request/groups.php',
data:'process=creategroup&groupname='+$groupname,
success:function(msg){
if(msg==1){
$(".creategroupbox .alert").html("Group Name exists");
}else{
$(".creategroupbox").dialog("close");	
$page = $(".managegroup #current").attr('p');
getrecords("",$page);	
}
}
})
}
});


$(document).on("click",".edit",function(){
$username=$(this).attr("id");
$email=$(this).attr("email");
$(".updateprofile #username").val($username);
$(".updateprofile #email").val($email);
$(".updateprofilediv .alert").html("");	
$(".updateprofilediv").dialog({
title:"Update Profile"
});
});

$(document).on("submit",".updateprofile",function(e){
e.preventDefault();	
if($(".updateprofile").valid()){
$.ajax({
url: "request/profile.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
getrecords("",1);	
$(".updateprofilediv").dialog("close");	
}
});
}
});


$(document).on("click",".changepin",function(){
$pin=$(this).attr("pin");
$(".uppin #pin").val($pin);
$(".changepindiv").dialog({
title:"Update Pin"
});
});

$(document).on("submit",".uppin",function(e){
e.preventDefault();	
if($(".uppin").valid()){
$.ajax({
url: "request/profile.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
getrecords("",1);	
$(".changepindiv").dialog("close");	
}
});
}
});


$(document).on("click",".changepassword",function(){
$(".updatepassworddiv").dialog({
title:"Update Password"
});
});

$(document).on("submit",".updatepassword",function(e){
e.preventDefault();	
if($(".updatepassword").valid()){
$.ajax({
url: "request/profile.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==1){	
getrecords("",1);	
$(".updatepassworddiv").dialog("close");	
}else {
	
$(".updatepassworddiv .alert").html("Your current password wrong.")
	
	}
}
});
}
});







$(document).on("click",".delete",function(){
$groupid=$(this).attr("id");
$.ajax({
type:'post',
url:'request/groups.php',
data:'process=deletegroup&id='+$groupid,
success:function(msg){
$page = $(".pagination li#current").attr('p');
getrecords("",$page);
}
});
});



});