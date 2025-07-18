$(document).ready(function(){
function getrecords($search,$page){
$.ajax({
type:'post',
url:'request/admin-service.php',
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

$(document).on("change",".searchserviceprovider",function(){
$search=$(this).val();    
$page = 1;
getrecords($search,$page);
});     
    



$(document).on("click","#refresh",function(){
$("#suser").val("");
$("#scord option:selected").val("");
getrecords("",1);
});


$(document).on("click",".create",function(){
$.ajax({
type:'post',
url:'request/admin-service.php',
data:'process=createhtmlservice',
success:function(msg){
$("#editcontent").html(msg);	
}
})	
});

$(document).on("change",".providerid",function(){
$providerid=$(this).val();
$.ajax({
type:'post',
url:'request/admin-service.php',
data:'provider='+$providerid+'&process=selectservice',
success:function(msg){
$(".serviceid").html(msg);
}
});
});	

$(document).on("click",".addgroup",function(){
if($(this).val()=="Add Group"){
$res=$(".dummydata #clonegroup").clone();
}else{
$res=$("#cloneuser").clone();
}
$(".grouptable tr:last").after($res);
$count=1;
$(".grouptable input,textarea,select").each(function(element){    
this.id =$count;
this.name=$count;
$count++;
});
});

$(document).on("change",".user",function(){
$userid=$(this).val();
$tr=$(this).closest("tr");
$.ajax({
type:'post',
url:'request/admin-service.php',
data:'user='+$userid+'&process=selectusergroup',
success:function(msg){
$tr.find('.group').val(parseInt(msg));
}
});
});	

$(document).on("click",".deletrow",function(){
$tr=$(this).closest("tr");
$tr.remove();
});


$(document).on("click",".save",function(){
if($("#serviceform").valid()){
function checkdupuser(){
$usercheck=$field1=$("#serviceform .user").map(function(){if($(this).val()!=""){return $(this).val();}}).get();	
var sorted_arr = $usercheck.sort(); 
var results = [];
for (var i = 0; i < $usercheck.length - 1; i++) {
if (sorted_arr[i + 1] == sorted_arr[i]) {
results.push(sorted_arr[i]);
}
}
$useralert="0";
if(results!=""){
unique=[];
var unique=results.filter(function(itm,i,results){
return i==results.indexOf(itm);
});
user=[];   
i=0;
unique.forEach(function(entry){
user[i++]=$('.dummydata .user option[value="'+entry+'"]').text();
});
alert("Duplicate Users : "+user);
$useralert="1";
}
return $useralert;    
}

function checkdupgroup(){
$usercheck=$field1=$("#serviceform .group").map(function(){if(
$(this).closest("tr").find(".user").val()==""){
return $(this).val();
}
}
).get();	
var sorted_arr = $usercheck.sort(); 
var results = [];
for (var i = 0; i < $usercheck.length - 1; i++) {
if (sorted_arr[i + 1] == sorted_arr[i]) {
results.push(sorted_arr[i]);
}
}
$groupalert="0";
if(results!=""){
unique=[];
var unique=results.filter(function(itm,i,results){
return i==results.indexOf(itm);
});
user=[];   
i=0;
unique.forEach(function(entry){
user[i++]=$('.dummydata .group option[value="'+entry+'"]').text();
});
alert("Duplicate Group : "+user);
$groupalert="1";
}
return $groupalert;    
}
$dupuserstatus=checkdupuser();
$dupgroupstatus=checkdupgroup();
if($dupuserstatus=="0" && $dupgroupstatus=="0"){
$providerid=$(".providerid").val();
$serviceid=$(".serviceid").val();
$displayname=$(".displayname").val();
$apiprovider=$(".apikey").val();
$status=$(".status").val();  
$userval=$("#serviceform .user").map(function(){return $(this).val();}).get();	
$groupval=$("#serviceform .group").map(function(){return $(this).val();}).get();
$buypriceval= $("#serviceform input.buyprice").map(function(){return $(this).val();}).get();
$sellpriceval=$("#serviceform input.sellprice").map(function(){return $(this).val();}).get();
$itemval=$("#serviceform input.item").map(function(){return $(this).val();}).get();
$mincountval=$("#serviceform input.mincount").map(function(){return $(this).val();}).get();
$maxcountval=$("#serviceform input.maxcount").map(function(){return $(this).val();}).get();
$autoorder=$(".autoorder").val();
$newstatus=$(".newstatus").val();
$.ajax({
type:'post',
url:'request/admin-service.php',
data:'providerid='+$providerid+'&serviceid='+$serviceid+'&displayname='+$displayname+'&apiprovider='+$apiprovider+'&status='+$status+'&userid='+$userval+'&groupid='+$groupval+'&buyprice='+$buypriceval+'&sellprice='+$sellpriceval+'&item='+$itemval+'&mincount='+$mincountval+'&maxcount='+$maxcountval+'&autoorder='+$autoorder+'&newstatus='+$newstatus+'&process=createservice',
success:function(msg){
alert("service has been created");
$("#editcontent").html("");
$page=$("#current").attr("p");
if($page===undefined){
$page=1;	
}
$search=$(this).attr('searchterms');
getrecords($search,$page);
}
});
}
}
});

$(document).on("click",".edit",function(){
$.ajax({
type:'post',
url:'request/admin-service.php',
data:'id='+$(this).attr('id')+'&process=editservice',
success:function(msg){
$("#editcontent").html(msg);
$("#editcontent").slideDown("slow");
$count=0;	
$(".grouptable input,textarea,select").each(function(element){    
this.id =$count;
this.name=$count;
$count++;
});
}
});
}); 

$(document).on("click",".delete",function(){
$page=$("#current").attr('p');
$.ajax({
type:'post',
url:'request/admin-service.php',
data:'service='+$(this).attr('id')+'&process=deleteservice',
success:function(){
getrecords("",$page);
}
});
});


$(document).on("click",".editsave",function(){
if($("#serviceform").valid()){
function checkdupuser(){
$usercheck=$field1=$("#serviceform .user").map(function(){if($(this).val()!=""){return $(this).val();}}).get();	
var sorted_arr = $usercheck.sort(); 
var results = [];
for (var i = 0; i < $usercheck.length - 1; i++) {
if (sorted_arr[i + 1] == sorted_arr[i]) {
results.push(sorted_arr[i]);
}
}
$useralert="0";
if(results!=""){
unique=[];
var unique=results.filter(function(itm,i,results){
return i==results.indexOf(itm);
});
user=[];   
i=0;
unique.forEach(function(entry){
user[i++]=$('.dummydata .user option[value="'+entry+'"]').text();
});
alert("Duplicate Users : "+user);
$useralert="1";
}
return $useralert;    
}

function checkdupgroup(){
$usercheck=$field1=$("#serviceform .group").map(function(){if(
$(this).closest("tr").find(".user").val()==""){
return $(this).val();
}
}
).get();	
var sorted_arr = $usercheck.sort(); 
var results = [];
for (var i = 0; i < $usercheck.length - 1; i++) {
if (sorted_arr[i + 1] == sorted_arr[i]) {
results.push(sorted_arr[i]);
}
}
$groupalert="0";
if(results!=""){
unique=[];
var unique=results.filter(function(itm,i,results){
return i==results.indexOf(itm);
});
user=[];   
i=0;
unique.forEach(function(entry){
user[i++]=$('.dummydata .group option[value="'+entry+'"]').text();
});
alert("Duplicate Group : "+user);
$groupalert="1";
}
return $groupalert;    
}
$dupuserstatus=checkdupuser();
$dupgroupstatus=checkdupgroup();
if($dupuserstatus=="0" && $dupgroupstatus=="0"){
$editid=$(".editid").val();
$providerid=$(".providerid").val();
$serviceid=$(".serviceid").val();
$displayname=$(".displayname").val();
$apiprovider=$(".apikey").val();
$status=$(".status").val();  
$userval=$("#serviceform .user").map(function(){return $(this).val();}).get();	
$groupval=$("#serviceform .group").map(function(){return $(this).val();}).get();
$buypriceval= $("#serviceform input.buyprice").map(function(){return $(this).val();}).get();
$sellpriceval=$("#serviceform input.sellprice").map(function(){return $(this).val();}).get();
$itemval=$("#serviceform input.item").map(function(){return $(this).val();}).get();
$mincountval=$("#serviceform input.mincount").map(function(){return $(this).val();}).get();
$maxcountval=$("#serviceform input.maxcount").map(function(){return $(this).val();}).get();
$autoorder=$(".autoorder").val();
$newstatus=$(".newstatus").val();
$.ajax({
type:'post',
url:'request/admin-service.php',
data:'editid='+$editid+'&providerid='+$providerid+'&serviceid='+$serviceid+'&displayname='+$displayname+'&apiprovider='+$apiprovider+'&status='+$status+'&userid='+$userval+'&groupid='+$groupval+'&buyprice='+$buypriceval+'&sellprice='+$sellpriceval+'&item='+$itemval+'&mincount='+$mincountval+'&maxcount='+$maxcountval+'&autoorder='+$autoorder+'&newstatus='+$newstatus+'&process=updateservice',
success:function(){
alert("Service has been updated");
$("#editcontent").html("");
$page=$("#current").attr("p");
$search=$(this).attr('searchterms');
getrecords($search,$page);
}
});
}
}
});	






});