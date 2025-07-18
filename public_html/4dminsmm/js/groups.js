$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/groups.php',
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
$groupid=$(this).attr("id");
$groupname=$(this).attr("groupname");
$(".editgroupbox #groupid").val($groupid);
$(".editgroupbox #groupname").val($groupname);
$(".upgroup .alert").html("");	
$(".editgroupbox").dialog({
title:"edit group"
});
});

$(document).on("submit",".upgroup",function(e){
e.preventDefault();	
if($(".upgroup").valid()){
$groupid=$(".editgroupbox #groupid").val();
$groupname=$(".editgroupbox #groupname").val();
$.ajax({
type:'post',
url:'request/groups.php',
data:'process=updategroup&id='+$groupid+'&groupname='+$groupname,
success:function($msg){
$msg=parseInt($msg);
if($msg==0){
$(".editgroupbox").dialog("close");
$page=$(".managegroup #current").attr('p');
getrecords("",$page);
}else{
$(".upgroup .alert").html("Group Name Already exits."); 
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