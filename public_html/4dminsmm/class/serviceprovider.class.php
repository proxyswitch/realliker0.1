<?php require_once("common.class.php");

class serviceprovider extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_admin_serviceprovider order by id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_admin_serviceprovider");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updateprovider($id,$groupname){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_serviceprovider where provider=? and id!=?");	
$sql->execute(array($groupname,$id));
$rowcount=$sql->rowCount();
if($rowcount==0){
$sql=$dbh->prepare("update smme_admin_serviceprovider set provider=? where id=?");	
$sql->execute(array($groupname,$id));
return 0;
}else{
return 1;	
}
}

function deleteprovider($id){
global $dbh;
$sql=$dbh->prepare("delete from smme_admin_serviceprovider where id=?");	
$sql->execute(array($id));
return "deleted successfully";
}

function createprovider($groupname){
global $dbh;	
$sql=$dbh->prepare("select * from smme_admin_serviceprovider where provider=?");
$sql->execute(array($groupname));
if($sql->rowCount()==0){
$sql=$dbh->prepare("insert into smme_admin_serviceprovider(`provider`)values(?)");
$sql->execute(array($groupname));
return "Provider has been created";
}else{
return "1";
} 
}

}
?>