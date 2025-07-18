$(document).ready(function(){
function gettickets($page){
$.ajax({
type:"post",
url:"request/usertickets.php",
data:"action=tickets&page="+$page,
success:function(msg){	
$("#content").html(msg);	
}	
});	
}
gettickets(1);
$(document).on("click",".orderpagination ul li.active",function(){
$page=$(this).attr("p");	
gettickets($search,$page);
});
});