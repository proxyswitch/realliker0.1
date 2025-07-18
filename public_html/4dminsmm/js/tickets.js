$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/tickets.php',
data:'process=getrecords&page='+$page+"&search="+$search,
success:function($msg){
$("#content").html($msg);
}
})
}
getrecords("",1);


$(document).on("click",".selectall",function(){
$(".tdeleteid").prop("checked",true);
});

$(document).on("click",".deselectall",function(){
$(".tdeleteid").prop("checked",false);
});	

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

$(document).on("click","#searchbtn",function(){
var searchquery=Array();
searchquery[0]=$("#suser").val();
searchquery[1]=$("#status option:selected").val();
$page=1;
if(searchquery!=""){
getrecords(searchquery,1);
}
});	 

$(document).on("click",".edit",function(){
$ticketid=$(this).attr("ticketid");	
$.ajax({
type:'post',
url:'request/tickets.php',
data:'process=viewtickets&ticketid='+$ticketid,
success:function($msg){
$(".replybox").dialog({title:"Histroy",width:"800", position: { my: 'top', at: 'top+50' },});	
$(".replybox").html($msg);
}	
});
});

$(document).on("click",".reply",function(){
$(".upreply")[0].reset();
$ticketid=$(this).attr("ticketid");	
$status=$(this).attr("status");
$(".upreply #ticketid").val($ticketid);
$(".upreply #tstatus").val($status);
$(".replyarea").dialog({title:"Reply to user",width:"500"})
});	

$(document).on("submit",".upreply",function(e){
e.preventDefault();	
if($(".upreply").valid()){
$ticketid=$(".upreply #ticketid").val(); 
$replytext=$(".upreply #replycomment").val();
$status=$(".upreply #tstatus option:selected").val(); 
$.ajax({
type:'post',
url:'request/tickets.php',
data:'process=updateticket&ticketid='+$ticketid+'&content='+$replytext+'&status='+$status,
success:function($msg){
$(".replyarea").dialog("close");
$(".alert").html($msg);
$search=$("ul.pagination li#current").attr("searchterms");
$page = $("ul.pagination li#current").attr('p');
getrecords($search,$page);
}
});
}
});

$(document).on("click",".tdelete",function(){
if($(".tdeleteid:checked").length>0){
$ids = [];
$('.tdeleteid:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
$.ajax({
type:'post',
url:'request/tickets.php',
data:'process=deleteticket&ids='+$ids,
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





});