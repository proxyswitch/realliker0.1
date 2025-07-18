$(document).ready(function(){

function pagloadingon(){
$(".pagloading").css("display","block");	
}

function pagloadingoff(){
$(".pagloading").css("display","none");	
}	

function orderajaxload(){
$(".orderloading").css("display","block");	
}
function orderajaxloadoff(){
$(".orderloading").css("display","none");	
}
	
$(document).on("click",".selectall",function(){
$(".selectmulti").prop("checked",true);
});

$(document).on("click",".deselectall",function(){
$(".selectmulti").prop("checked",false);
});


function changestatus($ids,$status){
$.ajax({
type:'post',
url:'request/getautoorders.php',
data:'action=autoorderaction&status='+$status+'&ids='+$ids,
success:function(msg){
$search=$("#current").attr('searchterms');
$page = $("#current").attr('p');
getrecords($search,$page); 
}
});	
}

$(document).on("click",".sstart",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Start");
}
}else{
alert("Select any one data");
}
});

$(document).on("click",".spause",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Pause");
}
}else{
alert("Select any one data");
}
});

$(document).on("click",".scancel",function(){
if($(".selectmulti:checked").length>0){
$ids = [];
$('.selectmulti:checked').each(function() {
$ids.push($(this).val());
});
$r=confirm("r u sure u want to do this operation");
if($r==true){
changestatus($ids,"Cancel");
}
}else{
alert("Select any one data");
}
});
	
function getrecords($search,$page){
$.ajax({
type:"post",
url:"request/getautoorders.php",
data:"action=orders&search="+$search+"&page="+$page,
success:function(msg){
$("#content").html(msg);	
}	
});	
}
getrecords("",1);
$(document).on("click",".orderpagination ul li.active",function(){
pagloadingon();	
$search=$(this).attr("searchterms");
$page=$(this).attr("p");	
getrecords($search,$page);	
pagloadingoff();
});

$(document).on("click","#refresh",function(){
$orderno=$("#orderno").val("");
$status=$("#status").val("");
$link=$("#slink").val("");
getrecords("",1);
});

$(document).on("click","#searchbtn",function(){
var searchquery=Array();
searchquery[0]=$("#orderno").val();
searchquery[1]=$("#slink").val();
searchquery[2]=$("#sservice option:selected").val();
searchquery[3]=$("#suser").val();
searchquery[4]=$("#pstatus").val();


if(searchquery!=""){
getrecords(searchquery,1);
}
});


	
});