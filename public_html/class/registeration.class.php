<?php require_once("../config/smmeconfig.php");

class smmeregister{

public function __construct(){
global $dbh;
$sql=$dbh->prepare("select * from smme_ip_ban_list where ipaddress=?");
$sql->execute(array($_SERVER['REMOTE_ADDR']));
if($sql->rowCount()==1){
header("location:securitycheck.php");	
exit;
}
}	

function secure_string($length) {
$str="";
$chars = "subinsblogabcdefgsdfdsfshijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($chars);
for($i = 0;$i < $length;$i++) {
$str .= $chars[rand(0,$size-1)];
}
return $str;
}	

function config(){
global $dbh;
$sql=$dbh->prepare("select fromemail from smme_admin_config");	
$sql->execute();
$res=$sql->fetch();	
return $res['fromemail'];	
}

function emailverification($uid){
global $dbh;	
$token=bin2hex(rand(34,16).date("dmy"));
$sql=$dbh->prepare("insert into smme_users_email_verification (`smmeid`,`token`,`ipaddress`) values(?,?,?)");
$sql->execute(array($uid,$token,$_SERVER['REMOTE_ADDR']));
return $token;	
}
	
function smmeuserreg($email,$name,$skype,$password){
global $dbh;
$sql=$dbh->prepare("select * from smme_users where username=? or email=?");
$sql->execute(array($email,$email));
if($sql->rowCount()==0){
$p_salt = $this->secure_string(20); 
$site_salt="regsoldsmmexchange";
$password= hash('sha256',$password.$site_salt.$p_salt);
$sql=$dbh->prepare("insert into smme_users (`username`,`email`,`password`,`ency`,`ipaddress`)values(?,?,?,?,?)");
$sql->execute(array($email,$email,$password,$p_salt,$_SERVER['REMOTE_ADDR']));
$smmeid=$dbh->lastInsertId();
$sql=$dbh->prepare("insert into smme_users_profile (`smmeid`,`name`,`skype`,`groups`)values(?,?,?,?)");
$sql->execute(array($smmeid,$name,$skype,1));
$sql=$dbh->prepare("insert into smme_users_wallet (`smmeid`,`balance`)values(?,?)");
$sql->execute(array($smmeid,0));
$from=$this->config();
$to=$email;
$_SESSION['siteregid']=base64_encode( openssl_random_pseudo_bytes(32));
$token=$this->emailverification($smmeid);
$emaillink="<a href='http://www.smmexchange.com/emailactivation?email=".$to."&emailtoken=".$token."'>Click here to verify your email.</a>";
$subject="Registration Completed - smmexchange";
$message="Hello ".$name."<br><br>
Thank you for registering with us.<br><br>
Please visit the link below to activate your account:  Link Here<br><br>
".$emaillink."";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);
return 2;	
}else {
return 1;
}	
}
}
?>