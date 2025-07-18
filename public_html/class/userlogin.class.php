<?php require_once("config/smmeconfig.php");
class smmelogin{
	
public function __construct(){
global $dbh;	
$sql=$dbh->prepare("select * from smme_ip_ban_list where ipaddress=?");
$sql->execute(array($_SERVER['REMOTE_ADDR']));
if($sql->rowCount()==1){
header("location:securitycheck.php");
exit;	
}		
}
	
function userlogin($uname,$password){
global $dbh;
$sql=$dbh->prepare("select * from smme_users where (username=? or email=?) and status=?");
$sql->execute(array($uname,$uname,0));
if($sql->rowCount()>0){
$res=$sql->fetch();
$uid=$res['id'];
$userpassword=$res['password'];
$username=$res['username'];
$email=$res['email'];
$p_salt=$res['ency'];
$site_salt="regsoldsmmexchange";
$salted_hash = hash('sha256',$password.$site_salt.$p_salt);
if($userpassword==$salted_hash){
$sql=$dbh->prepare("insert into smme_users_login_histroy(`smmeid`,`ipaddress`,`logintime`)values(?,?,?)");
$sql->execute(array($uid,$_SERVER['REMOTE_ADDR'],date("y-m-d h:m:i")));	
$_SESSION['smmebhaveshsitelike']=$uname;
$_SESSION['sitelogid']=base64_encode( openssl_random_pseudo_bytes(32));
$_SESSION['csrfTOken']=base64_encode(openssl_random_pseudo_bytes(32));

$sql=$dbh->prepare("delete from smme_users_login_failed where username=?");
$sql->execute(array($uname));
header("location:smme-dashboard.php");
}else{
$sql=$dbh->prepare("select * from smme_users_login_failed where `username`=? and `ipaddress`=? and date=?");
$sql->execute(array($uname,$_SERVER['REMOTE_ADDR'],date("Y-m-d")));
if($sql->rowCount()>2){
$sql=$dbh->prepare("update smme_users set status=?,reason=? where username=? or email=?");
$sql->execute(array(1,"Mulitiple failed login from".$_SERVER['REMOTE_ADDR'],$uname,$uname));	
}else{
$sql=$dbh->prepare("insert into smme_users_login_failed (`username`,`password`,`ipaddress`,`date`)values(?,?,?,?)");
$sql->execute(array($uname,$password,$_SERVER['REMOTE_ADDR'],date("Y-m-d")));
}
$sql=$dbh->prepare("select * from smme_users_login_failed where `username`=? and `ipaddress`=? and date=?");
$sql->execute(array($uname,$_SERVER['REMOTE_ADDR'],date("Y-m-d")));
$attemts=$sql->rowCount();
header("location:index.php?msg=failed&attempts=".$attemts."");
}
}else {
$sql=$dbh->prepare("select * from smme_users_login_failed where username=? and ipaddress=? and date=?");
$sql->execute(array($uname,$_SERVER['REMOTE_ADDR'],date("Y-m-d")));
if($sql->rowCount()>5){
$sql=$dbh->prepare("insert into smme_ip_ban_list(`ipaddress`,`from`)values(?,?)");
$sql->execute(array($_SERVER['REMOTE_ADDR'],1));
}else{
$sql=$dbh->prepare("insert into smme_users_login_failed (`username`,`password`,`ipaddress`,`date`)values(?,?,?,?)");
$sql->execute(array($uname,$password,$_SERVER['REMOTE_ADDR'],date("Y-m-d")));
}	
header("location:index.php?msg=failed");
}
}	
}
?>