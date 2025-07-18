$(document).ready(function(){
	
function pagloadingon(){
$(".pagloading").css("display","block");	
}

function pagloadingoff(){
$(".pagloading").css("display","none");	
}	
	
	
function getrecords($page){
$.ajax({
type:"post",
url:"request/gettransaction.php",
data:"action=transaction&&page="+$page,
success:function(msg){
$("#content").html(msg);	
}	
});	
}
getrecords(1);
$(document).on("click",".orderpagination ul li.active",function(){
pagloadingon();	
$page=$(this).attr("p");	
getrecords($page);
pagloadingoff();	
});
});