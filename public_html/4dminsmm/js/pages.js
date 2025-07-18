$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/pages.php',
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
title:"New Service"
});	
});


$(document).on("submit",".creategroup",function(e){
e.preventDefault();	
if($(".creategroup").valid()){
$.ajax({
url: "request/pages.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==1){
$(".creategroupbox .alert").html("Page Name exists");
}else{
$(".creategroupbox").dialog("close");	
$page = $(".pagination #current").attr('p');
getrecords("",$page);	
}
	
}
});	
}
});

$(document).on("click",".edit",function(){
$pagename=$(this).attr("pagename");
$id=$(this).attr("id");
$(".editgroupbox #pagename").val($pagename);
$(".editgroupbox #id").val($id);
$(".upgroup .alert").html("");	
$.ajax({
type:'post',
url:'request/pages.php',
data:'process=pagedetails&id='+$id,
success:function(msg){
$(".editgroupbox #content").html(msg);	
}
});
$(".editgroupbox").dialog({
title:"edit Service"
});
});


$(document).on("submit",".upgroup",function(e){
e.preventDefault();	
if($(".upgroup").valid()){
$.ajax({
url: "request/pages.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function($msg){
$msg=parseInt($msg);
if($msg==0){
$(".editgroupbox").dialog("close");
$page=$(".pagination #current").attr('p');
getrecords("",$page);
}else{
$(".upgroup .alert").html("Page Name Already exits."); 
}
}
});
}
});


$(document).on("click",".delete",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/pages.php',
data:'process=deletepage&id='+$id,
success:function(msg){
$page = $(".pagination li#current").attr('p');
getrecords("",$page);
}
});
});


});