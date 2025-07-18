$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/login-failed.php',
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

$(document).on("click",".banip",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/login-failed.php',
data:'process=banip&id='+$id,
success:function(msg){
$page = $(".managegroup #current").attr('p');
getrecords("",$page);	
}
})
})

$(document).on("click",".unbanip",function(){
$id=$(this).attr("id");
$.ajax({
type:'post',
url:'request/login-failed.php',
data:'process=unbanip&id='+$id,
success:function(msg){
$page = $(".managegroup #current").attr('p');
getrecords("",$page);	
}
})
})


});