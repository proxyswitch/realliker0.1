<?php include_once("smmeconfig.php");
class contactus{
function adminconfig(){
global $dbh;
$sql=$dbh->prepare("select supportemail from smme_admin_config");
$sql->execute();	
$res=$sql->fetch();	
return $res['supportemail'];
}
function sendto($email,$name,$content){
$from=$email;
$to=$this->adminconfig();
$subject="Feedback from contact us form";
$message=$content;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);
}
}