$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/profit.php',
data:'process=getrecords&page='+$page+"&search="+$search,
success:function($msg){
$("#content").html($msg);
}
})
}
getrecords("",1);
$(document).on("click",'.pagination li.active',function(){
$search=$(this).attr("searchterms");
$search=$search.split(",");
$page = $(this).attr('p');
getrecords($search,$page);
});    
$(document).on("click","#searchbtn",function(){
$fdate=$("#fdate").val();
$tdate=$("#tdate").val();
$suser=$("#suser").val();
$stype=$("#sservice option:selected").val();
var searchquery=Array();
searchquery[0]=$fdate;
searchquery[1]=$tdate;
searchquery[2]=$stype;
searchquery[3]=$suser;
getrecords(searchquery,1);
});
});