<?php require_once("../class/createautoorders.class.php");
if(isset($_POST['service']) && $_POST['csrfToken']==$_SESSION['csrfTOken']){
$orderobj=new createautoorder();
$res=$orderobj->createautomaticorder($_POST['service'],$_POST['url'],$_POST['count'],$_POST['noofpost']);
if($res==1){
$msgs="Your request has been added successfully.";
}else if($res==2){
$msgs="We can't process your request. Username Already in quee.";	
}
echo $msgs;	
}
?>