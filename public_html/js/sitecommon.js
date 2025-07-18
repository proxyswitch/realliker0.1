$(document).ready(function(){
$(".addbalance").validate();
$(".notifi").click(function()
{
$(".useralertnoti").fadeToggle(300);
usernotificationlist();
notificationoff();
return false;
});

//Document Click
$(document).click(function()
{
$(".useralertnoti").hide();
});
//Popup Click
$(".useralertnoti").click(function()
{
return false
});	
function orderajaxload(){
$(".orderloading").css("display","block");	
}
function orderajaxloadoff(){
$(".orderloading").css("display","none");	
}

$(document).on("click",".singleorder",function(){
$(".multidiv").hide();
$(".singlediv").show();	
$("#ordertype").val(1);
});	

$(document).on("click",".multipleorder",function(){
$(".multidiv").show();
$(".singlediv").hide();
$("#ordertype").val(2);
});	

$(".urls").on("focusout",function(){
var lines = $('.urls').val().split('\n');
var tcount=lines.length;
trows=tcount-1;
r=0;
html="";
for(var i=0;i<lines.length;i++){
line=lines[i].trim();
if(line.length!=0){
html +=line;
if(r<trows){
html +='\n';
}
}
r++;
}
$('.urls').val(html);

var lines = $('.urls').val().split('\n');
checkline=lines;
if(checkline!=""){
$count=0;
r=1;
$min=$("#min").val();
$max=$("#max").val();
for(var i = 0;i<lines.length;i++){
line=lines[i].trim();	
checkformat=line.split("|").length-1;
if(checkformat==1){
formatsplit=lines[i].split("|");
singlecount=Math.round(formatsplit[1]);
if(singlecount>0){
if(Number(singlecount)< Number($min)){
alert("minimum count per url " +$min+ " only");
$count=parseInt($count)+parseInt($min);
}
else if(Number(singlecount)> Number($max)){
alert("maximum count per url " +$max+ " only");
$count=parseInt($count)+parseInt($max);
}
else{$count=parseInt($count)+parseInt(singlecount);
}}else{
/*alert("please check count value.");*/	
}
}else{
/*alert("please check format at line no: "+r);*/	
}
r++;
}
$price=calculatePrice($count,$("#serviceprice").val(),$("#scount").val());
$(".totalprice").html("Total Price : $" +$price);
}
});


$(".service").on("change",function(){
$(".extdatadiv").css("display","none");
$(".extdatadivc").css("display","none");
if($(this).val()!=""){	
$service=$(this).val();
if($service==50){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mentions Hashtag");
}else if($service==111 || $service==113){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mentions User Followers");
}else if($service==52){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mentions Media Likers");
}else if($service==53){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mention");
}else{
$(".extdatadiv").css("display","none");
}

if($service==110 || $service==112 || $service==117 ){

$(".extdatadivc").css("display","block");
$(".mentionlabel").html("Custom Comments");

}else{

$(".extdatadivc").css("display","none");
}




$.ajax({
type:'POST',
url:'request/getservicedetails.php',
data:'service='+$service+'&action=servicedetails',
success:function(msg){
$res=msg.split("@#$");
$(".priceitem").html('Price Per Count :$'+$res[0]+' / '+$res[1]);
$("#countre").html('Min Order Count :'+$res[2]+' Max Order Count :'+$res[3]);
$("#serviceprice").val($res[0]);
$("#scount").val($res[1]);
$("#min").val($res[2]);
$("#max").val($res[3]);	 
}
});
}
});
function getb(){
$.ajax({
type:'POST',
url:'request/getservicedetails.php',
data:'action=balance',
success:function(msg){
$(".bal").html(msg);
}
});	
}
function calculatePrice(orderCount, servicePrice, servicePricePerItem)
{
$("#sprice").val(servicePrice);
//alert(orderCount+servicePrice+servicePricePerItem);
var orderCountSlice = orderCount / servicePricePerItem;
var intOrderCountSlice = parseInt(orderCountSlice);
if(orderCountSlice < 1 && orderCountSlice > 0)
{
intOrderCountSlice = 1;
}
else if(intOrderCountSlice < orderCountSlice)
{
intOrderCountSlice = intOrderCountSlice + 1;
}
var price = (intOrderCountSlice * servicePrice).toFixed(2);
return price;
}
/*$(".service").on("change",function(){
if($(this).val()!=""){	
$service=$(this).val();
if($service==50){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mentions Hashtag");
}else if($service==51){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mentions User Followers");
}else if($service==52){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mentions Media Likers");
}else if($service==53){
$(".extdatadiv").css("display","block");
$(".mentionlabel").html("Mention");
}else{
$(".extdatadiv").css("display","none");
}
$.ajax({
type:'POST',
url:'request/getservicedetails.php',
data:'service='+$service+'&action=servicedetails',
success:function(msg){
$res=msg.split("@#$");
$(".priceitem").html('Price Per Count :$'+$res[0]+' / '+$res[1]);
$("#countre").html('Min Order Count :'+$res[2]+' Max Order Count :'+$res[3]);
$("#serviceprice").val($res[0]);
$("#scount").val($res[1]);
$("#min").val($res[2]);
$("#max").val($res[3]);	 
}
});
}
});*/


$("#count").on("focusout",function(){
$min=$("#min").val();
$max=$("#max").val();
$count="Min: "+$min+"  Max: "+$max;
$count=$("#count").val();
if(Number($count)< Number($min)){
alert("minimum count " +$min+ " only");
$("#count").val($min);
}
else if(Number($count)> Number($max)){
alert("maximum count " +$max+ " only");
$("#count").val($max);
}
$price=calculatePrice($(this).val(),$("#serviceprice").val(),$("#scount").val());
$(".totalprice").html("Total Price : $" +$price);
});	


$("#count").on("keyup",function(){
$price=calculatePrice($(this).val(),$("#serviceprice").val(),$("#scount").val());
$(".totalprice").html("Total Price : $" +$price);
});	

$(document).on("submit",".serviceform1",function(e){
e.preventDefault();	
if($(".serviceform1").valid()){
orderajaxload();	
$.ajax({
url: "request/createorder.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
orderajaxloadoff();	
$(".orderalert").html(msg);
getb();
}
});	
}
});


$(document).on("submit",".addbalance",function(e){
e.preventDefault();	
if($(".addbalance").valid()){
$amount=$(".addbalance #amount").val();

if($(".addbalance .payvia").val()=="paypal"){
$min=$("#minamt").val();
if(Number($amount)<=$min){
$amount=$min;
$(".addbalance #amount").val($min);	
}
$(".paypalform .amount").val($amount);
$(".paypalform").submit();
}
else if($(".addbalance .payvia").val()=="2checkout"){
$min=$("#minamt1").val();
if(Number($amount)<=$min){
$amount=$min;
$(".addbalance #amount").val($min);	
}
$(".2coform .amount").val($amount);
$(".2coform").submit();
}
}	
});

$(document).on("submit",".profileupdate",function(e){
e.preventDefault();	
if($(".profileupdate").valid()){
$.ajax({
url: "request/profileupdate.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==1){
window.location="smme-profile?msg=upsuccess";	
}else {
$(".profileform .alert").html("Skype already exists please check.");	
}	
}
});	
}
});


$(document).on("submit",".changepassword",function(e){
e.preventDefault();	

if($(".changepassword").valid()){
$.ajax({
url: "request/changepassword.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==1){
window.location="smme-profile?msg=cpsuccess";	
}else {
$(".passwordform .alert").html("Check your current password.");	
}		
}
});	
}
});

$(document).on("click",".resend",function(){
$.ajax({
url: "request/activationlink.php", 
type: "POST",            
data:"process=resend",
success: function(){
	
$(".activealert").html("We have send mail please check.");	
}
});	
});



$(document).on("submit",".createticket",function(e){
e.preventDefault();	
if($(".createticket").valid()){
$.ajax({
url: "request/usertickets.php", 
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==1){
window.location="smme-tickets.php?msg=ctsuccess";	
}else {
window.location="smme-tickets.php?msg=tusuccess";	
}		
}
});	
}
});

$(document).on("submit",".replyticekt",function(e){
e.preventDefault();	
if($(".replyticekt").valid()){
$.ajax({
url: "request/usertickets.php",
type: "POST",            
data: new FormData(this),
contentType: false,      
cache: false,           
processData:false,    
success: function(msg){
if(msg==1){
window.location="smme-tickets.php?msg=tusuccess";	
}else {
window.location="smme-tickets.php?msg=tufailed";	
}		
}
});	
}
});

function notificationoff(){
$.ajax({
type:'post',
url: "request/usernotification.php", 
data:'action=notificationoff',
success:function($msg){
$(".newnoti").hide();
}	
})
}
function usernotification(){
$.ajax({
type:'post',
url: "request/usernotification.php", 
data:'action=notificationalert',
success:function(msg){
$msg=msg.split("#");	
$(".round").html($msg[1]);
if($msg[0]==1){
$(".newnoti").show();
}	
}	
})
}
function usernotificationlist(){
$.ajax({
type:'post',
url: "request/usernotification.php", 
data:'action=notificationlist',
success:function($msg){
$(".usernotilist").html($msg);	
}	
})
}
usernotification();
var usernotificationinterval=setInterval(usernotification,10*1000);
});