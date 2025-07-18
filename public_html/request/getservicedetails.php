<?php require_once("../class/commonsetting.class.php");
if(isset($_POST['action'])!=""){
$ac=new common();
switch($_POST['action'])
{
case "balance":
$msg=$ac->profiledetails($_SESSION['smmebhaveshsitelike']);
echo "$".$msg['balance'];
break;
case "servicedetails":
$msg=$ac->getservicedetails($_POST['service']);
echo $msg;
break;	
}
	}
?>