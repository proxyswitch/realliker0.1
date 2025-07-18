$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/admin-transaction.php',
data:'process=getrecords&page='+$page+"&search="+$search,
success:function($msg){
$("#content").html($msg);
}
})
}
getrecords("",1);

$(document).on("click",'.pagination li.active',function(){
$search=$(this).attr('searchterms');
$search=$search.split(",");
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
searchquery[1]=$("#scord option:selected").val();
$page=1;
if(searchquery!=""){
getrecords(searchquery,1);
}
});	 
});