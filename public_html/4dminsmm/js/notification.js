$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/notification.php',
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
title:"New Notification"
});	
});


$(document).on("submit",".creategroup",function(e){
e.preventDefault();	
if($(".creategroup").valid()){
$.ajax({
url: "request/notification.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
$(".creategroupbox").dialog("close");	
$page = $(".pagination #current").attr('p');
getrecords("",$page);	
}
});	
}
});

$(document).on("click",".edit",function(){
$id=$(this).attr("id");
$(".editgroupbox #id").val($id);
$(".upgroup .alert").html("");	
$.ajax({
type:'post',
url:'request/notification.php',
data:'process=notificationdetails&id='+$id,
success:function(msg){
msg=msg.split("#reslike");	
$(".editgroupbox #content").html(msg[0]);
$(".editgroupbox #status").val(msg[1]);	
}
});
$(".editgroupbox").dialog({
title:"edit Notification"
});
});


$(document).on("submit",".upgroup",function(e){
e.preventDefault();	
if($(".upgroup").valid()){
$.ajax({
url: "request/notification.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function($msg){
$(".editgroupbox").dialog("close");
$page=$(".pagination #current").attr('p');
getrecords("",$page);
}
});
}
});


$(document).on("click",".delete",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/notification.php',
data:'process=deletepage&id='+$id,
success:function(msg){
$page = $(".pagination li#current").attr('p');
getrecords("",$page);
}
});
});


});