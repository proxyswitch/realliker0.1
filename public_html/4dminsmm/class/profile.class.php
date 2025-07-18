<?php require_once("common.class.php");

class profile extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_admin_user order by id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_admin_user");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","profile");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updateadmin($username,$email){
global $dbh;
$sql=$dbh->prepare("update smme_admin_user set username=?,email=? where id=?");	
$sql->execute(array($username,$email,1));
}

function updatepin($pin){
global $dbh;
$sql=$dbh->prepare("update smme_admin_user set pin=? where id=?");
$sql->execute(array($pin,1));
}

function updatepassword($currentpassword,$newpassword){
global $dbh;	
$sql=$dbh->prepare("select password,ency from smme_admin_user where id=?");
$sql->execute(array(1));
$old=$sql->fetch();
$oldpassword=$old['password'];
$securesalt=$old['ency'];
$site_salt="testsmmeadminsecurepanel";
$salted_hash = hash('sha256',$currentpassword.$site_salt.$securesalt);
if($oldpassword==$salted_hash){ 
$p_salt=$this->rand_string(20); 
$site_salt="testsmmeadminsecurepanel";
$password= hash('sha256',$newpassword.$site_salt.$p_salt);
$sql=$dbh->prepare("update smme_admin_user set password=?,ency=? where id=?");
$sql->execute(array($password,$p_salt,1));
return 1;
}else {
return 0;
}	
}

}
?>