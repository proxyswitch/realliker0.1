<?php require_once("../class/activationlink.class.php");
print_r($_POST);
if(isset($_POST['process']) && $_POST['process']="resend"){
echo 1;	
$obj=new resendlink();
echo $obj->sendactivationlink();
}