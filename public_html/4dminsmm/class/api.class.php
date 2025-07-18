<?php require_once("common.class.php");

class api extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_admin_api order by id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_admin_api");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","profile");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updateapi($apiname,$key,$id){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_api where apiname=? and id!=?");
$sql->execute(array($apiname,$id));
if($sql->rowCount()==0){
$sql=$dbh->prepare("update smme_admin_api set `apiname`=?,`key`=? where `id`=?");	
$sql->execute(array($apiname,$key,$id));
print_r($sql->errorInfo());
return 0;
}else {
return $apiname.$key.$id;	
}
}

function addapi($apiname,$key){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_api where apiname=?");
$sql->execute(array($apiname));
if($sql->rowCount()==0){
$sql=$dbh->prepare("insert into smme_admin_api(`apiname`,`key`) values(?,?)");	
$sql->execute(array($apiname,$key));
return 0;
}else{
return 1;	
}
}

function deleteapi($id){
global $dbh;
$sql=$dbh->prepare("delete from smme_admin_api where id=?");
$sql->execute(array($id));	
}
}
?>