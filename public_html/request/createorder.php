<?php require_once("../class/makeorder.class.php");
if(isset($_POST['service']) && $_POST['csrfToken']==$_SESSION['csrfTOken']){
$orderobj=new createorder();
if($_POST['ordertype']==1){
if($_POST['url']{strlen($_POST['url']) - 1}=='/'){
$url=substr($_POST['url'], 0, strlen($_POST['url']) - 1);
}else {
$url=$_POST['url'];
}
if(isset($_POST['extdata'])){
$extdata=$_POST['extdata'];
}else{
$extdata="";
}	

if(isset($_POST['ccomments'])){
$ccomments=$_POST['ccomments'];
}else{
$ccomments="";
}

$res=$orderobj->order($_POST['service'],str_replace(' ','',$url),$_POST['count'],$extdata,$ccomments);
if($res==1){
$msgs="Your order has been added successfully.";
}else if($res==2){
$msgs="We can't process your order kindly check url.";	
}else if($res==3){
$msgs="Insufficient balance.Please add amount to your account.";	
}
echo $msgs;	
}else {
$msgs="";
$successcount=0;
$failedcount=0;
$insufficient=0;
$faileddetails="";
$service=$_POST['service'];
$datas = trim($_POST['urls']);
$urlcon = explode("\n", $datas);
$seperateline = array_filter($urlcon, 'trim'); 
$i=1;
foreach ($seperateline as $line) {
$checkcount=substr_count($line,'|');	
if($checkcount==1){
$splitstr=explode("|",$line);
$url=trim($splitstr[0]);
$count=trim($splitstr[1]);
if($count!==0 && is_numeric($count)){
if($url{strlen($url) - 1}=='/'){
$url=substr($url, 0, strlen($url) - 1);
}else {
$url=$url;
}
$extdata="";	
$res=$orderobj->order($service,str_replace(' ','',$url),$count,$extdata,$ccomments);
if($res==1){
$successcount++;
}else if($res==2){
$failedcount++;	
}else if($res==3){
$insufficient=1;
break; 
}
else{
$failedcount++;	
$faileddetails.="line no: ".$i."-".$line."<br>";	
}
}
}
else{
$failedcount++;	
$faileddetails.="line no: ".$i."-".$line."<br>";	

}
$i++;
}
if($successcount>0){
$msgs.=$successcount." order has been added successfully.<br>"; 	
}
if($failedcount>0){
$msgs.=$failedcount." order failed due to wrong format.<br>";	
$msgs.=$faileddetails;
}
if($insufficient>0){
$msgs.="Further order's stopped due to insufficient balance.<br>";		
}
echo $msgs;
}	
}
?>