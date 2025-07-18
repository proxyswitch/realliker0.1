$(document).ready(function(){
function defaultresult($page){
$.ajax({
type:'post',
url:'request/getoldorders.php',
data:'process=getrecord&page='+$page,
success:function($msg){
$res=$msg.split("splitforpage");
$("#content").html($msg);
}
})
}
defaultresult(1);
$(document).on('click','.orderpagination li.active',function(){
$page = $(this).attr('p');
defaultresult($page);
});    
});