$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/users-api.php',
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
$(document).on("click","#search",function(){
$id=$("#suser").val();
getrecords($id,1);
});

$(document).on("click",".enable",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/users-api.php',
data:'process=enable&id='+$id,
success:function($msg){
$search=$(".pagination #current").attr('searchterms');
$page = $(".pagination #current").attr('p');
getrecords($search,$page);	
}
});
});

$(document).on("click",".disable",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/users-api.php',
data:'process=disable&id='+$id,
success:function($msg){
$search=$(".pagination #current").attr('searchterms');
$page = $(".pagination #current").attr('p');
getrecords($search,$page);	
}
});
});




});