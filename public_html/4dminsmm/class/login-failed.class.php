<?php require_once("common.class.php");

class loginfailed extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_users_login_failed order by id desc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_users_login_failed");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function banip($id){
global $dbh;	
$sql=$dbh->prepare("select * from smme_users_login_failed where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
$sql=$dbh->prepare("update smme_users_login_failed set status=? where ipaddress=?");
$sql->execute(array(1,$res['ipaddress']));	
$sql=$dbh->prepare("insert into smme_ip_ban_list (`ipaddress`,`from`) values (?,?)");
$sql->execute(array($res['ipaddress'],1));
}

function unbanip($id){
global $dbh;	
$sql=$dbh->prepare("select * from smme_users_login_failed where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
$sql=$dbh->prepare("update smme_users_login_failed set status=? where ipaddress=?");
$sql->execute(array(0,$res['ipaddress']));	
$sql=$dbh->prepare("delete from smme_ip_ban_list where ipaddress=?");
$sql->execute(array($res['ipaddress']));
}

}
?>