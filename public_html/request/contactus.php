<?php require_once("../class/contactus.class.php");
if(isset($_POST['email']) && isset($_POST['name'])){
$smmeobj=new contactus();
$res=$smmeobj->sendto($_POST['email'],$_POST['name'],$_POST['message']);
echo $res;
}
?>