<?php require_once("connection.php");
class login{
function adminlogin($username,$password,$pin){
global $dbh;
$sql=$dbh->prepare("SELECT * FROM smme_admin_user WHERE username=? and pin=?");
$sql->execute(array($username,$pin));
if($sql->rowCount()==1){
while($r=$sql->fetch()){
$p=$r['password'];
$p_salt=$r['ency'];
$id=$r['id'];
$user=$r['username'];
}
$site_salt="testsmmeadminsecurepanel";
$salted_hash = hash('sha256',$password.$site_salt.$p_salt);
if($p==$salted_hash){
$_SESSION['smmmebhaveshadmin']=$user;
header("location:smme-dashboard.php");
}
else{
header("location:index.php?act=n");
}	
}
else{
header("location:index.php?act=n");
}
}	
}