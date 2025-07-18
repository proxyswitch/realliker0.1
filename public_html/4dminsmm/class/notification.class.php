<?php require_once("common.class.php");
class notification extends common{
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_users_notification order by id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_users_notification");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updatenotification($content,$status,$id){
global $dbh;
$sql=$dbh->prepare("update smme_users_notification set content=?,status=? where id=?");	
$sql->execute(array($content,$status,$id));
if($status==0){
$sql=$dbh->prepare("update smme_users_profile set notification=?");	
$sql->execute(array(1));
}
}

function notificationdetails($id){
global $dbh;	
$sql=$dbh->prepare("select * from smme_users_notification where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
return $res['content']."#reslike".$res['status'];
}

function deletenotification($id){
global $dbh;
$sql=$dbh->prepare("delete from smme_users_notification where id=?");	
$sql->execute(array($id));
return "deleted successfully";
}

function addnotification($content,$status){
global $dbh;	
$sql=$dbh->prepare("insert into smme_users_notification(`content`,`status`)values(?,?)");
$sql->execute(array($content,$status));
$sql=$dbh->prepare("update smme_users_profile set notification=?");	
$sql->execute(array(1));
return "Notification has been created";
}
}
?>