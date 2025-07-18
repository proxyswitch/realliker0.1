$(document).ready(function(){

function pagloadingon(){
$(".pagloading").css("display","block");	
}

function pagloadingoff(){
$(".pagloading").css("display","none");	
}	
	
	
function getrecords($search,$page){
$.ajax({
type:"post",
url:"request/getorders.php",
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
$orderno=$("#orderno").val();
$status=$("#status").val();
$link=$("#slink").val();
$search=Array();
$search[0]=$orderno;
$search[1]=$status;
$search[2]=$link;
if($search){
getrecords($search,1);
}
});	
});