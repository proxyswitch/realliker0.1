$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/fixedservice.php',
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


$(".addservice").on("click",function(){
if($(".creategroup").valid()){
$provider=$(".creategroup #provider").val();
$service=$(".creategroup #service").val();
$.ajax({
type:'post',
url:'request/fixedservice.php',
data:'process=createfixedservice&provider='+$provider+'&service='+$service,
success:function(msg){
if(msg==1){
$(".creategroupbox .alert").html("Service Name exists");
}else{
$(".creategroupbox").dialog("close");	
$page = $(".pagination #current").attr('p');
getrecords("",$page);	
}
}
})
}
});


$(document).on("click",".edit",function(){
$provider=$(this).attr("provider");
$service=$(this).attr("service");
$id=$(this).attr("id");
$(".editgroupbox #provider").val($provider);
$(".editgroupbox #service").val($service);
$(".editgroupbox #id").val($id);
$(".upgroup .alert").html("");	
$(".editgroupbox").dialog({
title:"edit Service"
});
});


$(document).on("submit",".upgroup",function(e){
e.preventDefault();	
if($(".upgroup").valid()){
$provider=$(".editgroupbox #provider").val();
$service=$(".editgroupbox #service").val();
$id=$(".editgroupbox #id").val();
$.ajax({
type:'post',
url:'request/fixedservice.php',
data:'process=updatefixedservice&provider='+$provider+'&service='+$service+'&id='+$id,
success:function($msg){
$msg=parseInt($msg);
if($msg==0){
$(".editgroupbox").dialog("close");
$page=$(".pagination #current").attr('p');
getrecords("",$page);
}else{
$(".upgroup .alert").html("Service Name Already exits."); 
}
}
});
}
});


$(document).on("click",".delete",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/fixedservice.php',
data:'process=deletefixedservice&id='+$id,
success:function(msg){
$page = $(".pagination li#current").attr('p');
getrecords("",$page);
}
});
});


});