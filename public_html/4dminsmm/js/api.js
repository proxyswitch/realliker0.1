$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/api.php',
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


$(document).on("click","#create",function(){
$(".createapi")[0].reset();
$(".createapibox").dialog({
title:"New Api"
});	
});


$(document).on("submit",".createapi",function(e){
e.preventDefault();	
if($(".createapi").valid()){
$.ajax({
url: "request/api.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
getrecords("",1);	
$(".createapibox").dialog("close");	
}
});
}
});


$(document).on("click",".edit",function(){
$apiname=$(this).attr("apiname");
$key=$(this).attr("key");
$id=$(this).attr("id");
$(".updateapi #apiname").val($apiname);
$(".updateapi #key").val($key);
$(".updateapi #id").val($id);	
$(".updateapibox").dialog({
title:"Update Api"
});
});

$(document).on("submit",".updateapi",function(e){
e.preventDefault();	
if($(".updateapi").valid()){
$.ajax({
url: "request/api.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
getrecords("",1);	
$(".updateapibox").dialog("close");	
}
});
}
});

$(document).on("click",".delete",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/api.php',
data:'process=deleteapi&id='+$id,
success:function(msg){
$page = $(".pagination li#current").attr('p');
getrecords("",$page);
}
});
});



});