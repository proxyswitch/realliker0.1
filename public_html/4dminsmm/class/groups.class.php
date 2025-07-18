<?php require_once("common.class.php");

class groups extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_users_group order by id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_users_group");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updategroup($id,$groupname){
global $dbh;
if($id!=1){
$sql=$dbh->prepare("select * from smme_users_group where group_name=? and id!=?");	
$sql->execute(array($groupname,$id));
$rowcount=$sql->rowCount();
if($rowcount==0){
$sql=$dbh->prepare("update smme_users_group set group_name=? where id=?");	
$sql->execute(array($groupname,$id));
return 0;
}else{
return 1;	
}
}
}

function deletegroup($id){
global $dbh;
if($id!=1){
$sql=$dbh->prepare("delete from smme_users_group where id=?");	
$sql->execute(array($id));
$sql=$dbh->prepare("update smme_users_profile set groups=? where groups=?");
$sql->execute(array(1,$id));
}
return "deleted successfully";
}

function creategroup($groupname){
global $dbh;	
$sql=$dbh->prepare("select * from smme_users_group where group_name=?");
$sql->execute(array($groupname));
if($sql->rowCount()==0){
$sql=$dbh->prepare("insert into smme_users_group(`group_name`)values(?)");
$sql->execute(array($groupname));
return "Group has been created";
}else{
return "1";
} 
}

}
?>