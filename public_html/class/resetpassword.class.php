<?php require_once("../config/smmeconfig.php");
class smmeresetpassword{
function secure_string($length) {
$str="";
$chars = "subinsblogabcdefgsdfdsfshijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($chars);
for($i = 0;$i < $length;$i++) {
$str .= $chars[rand(0,$size-1)];
}
return $str;
}	
function smmeusergetpassword($email){
global $dbh;
$sql=$dbh->prepare("select * from smme_users where email=?");
$sql->execute(array($email));
if($sql->rowCount()==1){
$sql=$dbh->prepare("select c.email.d.name from smme_users c,smme_users_profile d where c.id=d.smmeid and c.email=?");
$sql->execute(array($email));
$profile=$sql->fetch();
$p_salt = $this->secure_string(20); 
$site_salt="regsoldsmmexchange";
$password="smme".rand(2,20).date("dhmi").$this->secure_string(3);
$stpassword= hash('sha256',$password.$site_salt.$p_salt);
$sql=$dbh->prepare("update smme_users set password=?,ency=?,changepass=? where email=?");
$sql->execute(array($stpassword,$p_salt,1,$email));
$_SESSION['siteforgetid']=base64_encode( openssl_random_pseudo_bytes(32));
$from="support@smmexchange.com";
$to=$email;	
$subject="Password Reset Request - smmexchange";
$message="Hello ".$profile['name']."<br><br>
We have received Request for reset your password. Please change this password after login.<br><br>
Your new password: ".$password."";
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