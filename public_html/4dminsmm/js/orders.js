$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/orders.php',
data:'process=getrecords&page='+$page+"&search="+$search,
success:function($msg){
$("#content").html($msg);
}
})
}
getrecords("",1);

$(document).on("click",'.pagination li.active',function(){
$search=$(this).attr("searchterms");
$page=$(this).attr('p');
getrecords($search,$page);
}); 

$(document).on("click","#refresh",function(){
getrecords("",1);
});

$(document).on("click","#searchbtn",function(){
var searchquery=Array();
searchquery[0]=$("#orderno").val();
searchquery[1]=$("#fdate").val();
searchquery[2]=$("#tdate").val();
searchquery[3]=$("#sservice option:selected").val();
searchquery[4]=$("#suser").val();
searchquery[5]=$("#pstatus").val();
searchquery[6]=$("#slink").val();

if(searchquery!=""){
getrecords(searchquery,1);
}
});	 

$(document).on("click",".selectall",function(){
$(".selectmulti").prop("checked",true);
});

$(document).on("click",".deselectall",function(){
$(".selectmulti").prop("checked",false);
});	

function changestatus($ids,$status){
$.ajax({
type:'post',
url:'request/orders.php',
data:'process=changestatus&status='+$status+'&ids='+$ids,
success:function(msg){
$search=$("#current").attr('searchterms');
$page = $("#current").attr('p');
getrecords($search,$page); 
}
});	
}

$(document).on("click",".sprocessing",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Processing");
}
}else{
alert("Select any one data");
}
});


$(document).on("click",".sproceed",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Proceed");
}
}else{
alert("Select any one data");
}
});


$(document).on("click",".scomplete",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Completed");
}
}else{
alert("Select any one data");
}
});


$(document).on("click",".srefund",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Refunded");
}
}else{
alert("Select any one data");
}
});

$(document).on("click",".serror",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Error");
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
url:'request/orders.php',
data:'process=deleteorder&ids='+$ids,
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

$(document).on("click",".edit",function(){
$id=$(this).attr("sid");
$.ajax({
type:'post',
url:'request/orders.php',
data:'process=getorderdetails&id='+$id,
success:function(msg){
$re=msg.split(",");
$(".uporder #orderid").val($re[1]);
$(".uporder #orderno").val($re[1]);
$(".uporder #count").val($re[2]);
$(".uporder #url").val($re[3]);
$(".uporder #status").val($re[4]);
$(".uporder #refund").val($re[5]);
$(".uporder #finishcount").val($re[6]);
$(".uporder #reason").val($re[7]);	
$(".uporder #startcount").val($re[8]);			 
$(".updateorderdetails").dialog({
title:"Update order"});   
}
});
});	


$(document).on("submit",".uporder",function(e){
e.preventDefault();	
if($(".uporder").valid()){
$.ajax({
url: "request/orders.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
$(".updateorderdetails").dialog("close");
$search=$("#current").attr('searchterms');
$page = $("#current").attr('p');
getrecords($search,$page);
}
});	
}
});



$(document).on("click","#downloadexcel",function(){
$sorderno=$("#orderno").val();
$fdate=$("#fdate").val();
$tdate=$("#tdate").val();
$stype=$("#sservice option:selected").val();
$suser=$("#suser").val();
$sstatus=$("#pstatus").val();
$searchquery="orderno="+$sorderno+"&from="+$fdate+"&to="+$tdate+"&type="+$stype+"&user="+$suser+"&status="+$sstatus+"&process=downloadexcel";
window.location = "downloadrecord.php?"+$searchquery;
});	 

$(document).on("click","#downloadtext",function(){
$sorderno=$("#orderno").val();
$fdate=$("#fdate").val();
$tdate=$("#tdate").val();
$stype=$("#sservice option:selected").val();
$suser=$("#suser").val();
$sstatus=$("#pstatus").val();
$searchquery="orderno="+$sorderno+"&from="+$fdate+"&to="+$tdate+"&type="+$stype+"&user="+$suser+"&status="+$sstatus+"&process=downloadtext";
window.location = "downloadrecord.php?"+$searchquery;
});	







});