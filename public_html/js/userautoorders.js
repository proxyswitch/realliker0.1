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

$(document).on("click","#search",function(){
$search=$("#suser").val();
if($search){
getrecords($search,1);
}
});


$(document).on("submit",".serviceform12",function(e){
e.preventDefault();	
if($(".serviceform12").valid()){
orderajaxload();	
$.ajax({
url: "request/createautoorders.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
orderajaxloadoff();	
$(".orderalert").html(msg);
getrecords("",1);
}
});	
}
});



$(document).on("click",".autoaction",function(){
$id=$(this).attr("id");
$status=$(this).val();
$.ajax({
url: "request/getautoorders.php", 
type: "POST",            
data:'action=autoorderaction&id='+$id+'&status='+$status,
success: function(){
orderajaxloadoff();	
getrecords("",1);
}
});	
});
});