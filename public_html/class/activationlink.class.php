<?php require_once("userprofile.class.php");
class resendlink extends profile{
function sendactivationlink(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$to=$profile['email'];
$uid=$profile['smmeid'];
$name=$profile['name'];
$config=$this->adminconfig();	
$from=$config['fromemail'];
$token=bin2hex(rand(34,16).date("dmy"));
$sql=$dbh->prepare("update smme_users_email_verification set token=?,ipaddress=? where smmeid=?");
$sql->execute(array($token,$_SERVER['REMOTE_ADDR'],$uid));	
print_r($sql->errorInfo());
$emaillink="<a href='http://www.smmexchange.com/emailactivation?email=".$to."&emailtoken=".$token."'>Click here to verify your email.</a>";
$subject="Activation Link - smmexchange";
$message="Hello ".$name."<br><br>
Thank you for registering with us.<br><br>
Please visit the link below to activate your account:  Link Here<br><br>
".$emaillink."";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);	
}
}
?>