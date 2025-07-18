<?php require_once("smmeconfig.php");

class accountverification{

function config(){
global $dbh;
$sql=$dbh->prepare("select fromemail from smme_admin_config");	
$sql->execute();
$res=$sql->fetch();	
return $res['fromemail'];	
}


function verifyemail($email,$token){
global $dbh;
$sql=$dbh->prepare("select smme_users.email,smme_users_profile.name,d.* from smme_users,smme_users_profile,smme_users_email_verification d where smme_users.email=? and smme_users.id=d.smmeid and smme_users.id=smme_users_profile.smmeid and d.token=?");
$sql->execute(array($email,$token));
if($sql->rowCount()==1){
$res=$sql->fetch();
$uid=$res['smmeid'];
$name=$res['name'];
if($res['status']==0){
$sql=$dbh->prepare("update smme_users_email_verification set status=?,ipaddress=? where smmeid=? and token=?");
$sql->execute(array(1,$_SERVER['REMOTE_ADDR'],$uid,$token));
$sql=$dbh->prepare("update smme_users set verified=? where email=? and id=?");
$sql->execute(array(1,$email,$uid));
$from=$this->config();
$to=$email;
$subject="Account Verified Successfully - smmexchange";
$message="Hello ".$name."<br><br>
Your account has been verified successfully.";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);
return 0;
}else {
return 1;
}
}else {
return 2;
}
}
}
?>