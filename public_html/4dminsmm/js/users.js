$(document).ready(function(){
function getrecords($username,$page){
$.ajax({
type:'post',
url:'request/users.php',
data:'process=getrecords&page='+$page+"&username="+$username,
success:function($msg){
$("#content").html($msg);
}
})
}
getrecords("",1);

$(document).on("click",'.pagination li.active',function(){
$username=$("#search").val();
$page=$(this).attr('p');
getrecords($username,$page);
}); 

$(document).on("click","#refresh",function(){
getrecords("",1);
});

$(document).on("click","#searchbtn",function(){
if($(".searchform").valid()){
$username=$("#search").val();
getrecords($username,1);	
}

});

$(document).on("click",".selectall",function(){
$(".selectmulti").prop("checked",true);
});

$(document).on("click",".deselectall",function(){
$(".selectmulti").prop("checked",false);
});	

$(document).on("click",".sactivate",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
$.ajax({
type:'post',
url:'request/users.php',
data:'process=changestatus&status=0&ids='+$ids,
success:function(msg){
$search=$("#current").attr('searchterms');
$page = $("#current").attr('p');
getrecords($search,$page); 
}
});
}
}else{
alert("Select any one data");
}
});

$(document).on("click",".sdeactivate",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
$.ajax({
type:'post',
url:'request/users.php',
data:'process=changestatus&status=1&ids='+$ids,
success:function(msg){
$search=$("#current").attr('searchterms');
$page = $("#current").attr('p');
getrecords($search,$page); 
}
});
}
}else{
alert("Select any one data");
}
});

$(document).on("click",".sdelete",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
$.ajax({
type:'post',
url:'request/users.php',
data:'process=multiuserdelete&ids='+$ids,
success:function(msg){
$search=$("#current").attr('searchterms');
$page = $("#current").attr('p');
getrecords($search,$page); 
}
});
}
}else{
alert("Select any one data");
}
});

$(document).on("click",".resendemailverify",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
$.ajax({
type:'post',
url:'request/users.php',
data:'process=resendemailverification&ids='+$ids,
success:function(msg){
$search=$("#current").attr('searchterms');
$page = $("#current").attr('p');
getrecords($search,$page); 
}
});
}
}else{
alert("Select any one data");
}
});


$(document).on("click",".delete",function(){
$username=$(this).attr('id');
$r=confirm("r u sure u want to delete user: "+$username);
if($r==true){
$.ajax({
type:'post',
url:'request/users.php',
data:'process=deleteuser&username='+$username,
success:function($msg){
$username=$("#search").val();
$page = $("#current").attr('p');
getrecords($username,$page);
}
});		
}
});	

$(document).on("click",".addbalance",function() {
$username=$(this).attr('id');
$("#amt").val("");
$(".alert").html(""); 
$(".showbalance #username").val($username);	
$(".showbalance").dialog({
title: "Add Balance"
});
});

$(document).on("submit",".makebalance",function(e){
e.preventDefault();	
if($(".makebalance").valid()){
$.ajax({
url: "request/users.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
$(".commonalert").html(msg); 
$(".showbalance").dialog("close");
$username=$("#search").val();
$page = $("#current").attr('p');
getrecords($username,$page);
}
});	
}
});


$(document).on("click",".changepass",function() {
$id=$(this).attr('id');
$(".uppassword #upid").val("");
$(".uppassword #unpass").val(""); 
$(".uppassword #upid").val($id);	
$(".passwordupdate").dialog({
title: "Password Update"
});
});


$(document).on("submit",".uppassword",function(e){
e.preventDefault();	
if($(".uppassword").valid()){
$.ajax({
url: "request/users.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,
success:function(msg){
$(".commonalert").html(msg); 	
$(".passwordupdate").dialog("close");
}
});	
}
});


$(document).on("click","#createuser",function(){
$(".createprofile #userpass").val("");
$(".createprofile #name").val("");
$(".createprofile #email").val("");
$(".createprofile #mono").val("");
$(".createprofile #whatsapp").val("");
$(".createprofile #group").val("");
$(".createprofile #activate").val("");

$(".profilecreate").dialog({
title:"New User Creation"
});
});


$(document).on("submit",".createprofile",function(e){
e.preventDefault();	
if($(".createprofile").valid()){
$.ajax({
url: "request/users.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,
success:function(msg){
if(msg==1){
$(".useralert").html("Username already exists");
}else if(msg==2){
$(".useralert").html("Email already exists");
}else {
$(".profilecreate").dialog("close");	
$username=$("#search").val();
$page = $("#current").attr('p');
getrecords($username,$page); 
}
}
});
} 
});






$(document).on('click','.edit',function(){
$uid=$(this).attr("id");
$username=$(this).attr("username");
$name=$(this).attr("name");
$email=$(this).attr("email");
$mono=$(this).attr("skype");
$group=$(this).attr("group");
$active=$(this).attr("activate");
$pcheckout=$(this).attr("pcheckout");
$checkoutauto=$(this).attr("chauto");
$payauto=$(this).attr("payauto");

$(".profileupdate #uid").val($uid);
$(".profileupdate #username").val($username);
$(".profileupdate #name").val($name);
$(".profileupdate #email").val($email);
$(".profileupdate #mono").val($mono);
$(".profileupdate #group").val($group);
$(".profileupdate #activate").val($active);
$(".profileupdate #pcheckout").val($pcheckout);
$(".profileupdate #checkoutauto").val($checkoutauto);
$(".profileupdate #paypalauto").val($payauto);



$(".profileupdate").dialog({
title:"User Details"
});
});

$(document).on("submit",".upprofile",function(e){
e.preventDefault();	
if($(".upprofile").valid()){
$.ajax({
url: "request/users.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,
success:function(msg){
if(msg==1){
$(".profileupdate .alert").html("UserName Already exists.");	
}else if(msg==2){
$(".profileupdate .alert").html("Email Already exists.");	
}else{	
$(".profileupdate").dialog("close");	
$username=$("#search").val();
$page = $("#current").attr('p');
getrecords($username,$page); 
}
}
});
} 
});









});