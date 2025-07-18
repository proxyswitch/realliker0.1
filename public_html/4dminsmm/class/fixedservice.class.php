<?php require_once("common.class.php");

class fixedservice extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select smme_admin_serviceprovider.provider,smme_admin_services_list.service,smme_admin_services_list.provider as providerid,smme_admin_services_list.id from smme_admin_serviceprovider,smme_admin_services_list where smme_admin_serviceprovider.id=smme_admin_services_list.provider order by smme_admin_serviceprovider.id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select smme_admin_serviceprovider.provider,smme_admin_services_list.service,smme_admin_services_list.provider as providerid,smme_admin_services_list.id from smme_admin_serviceprovider,smme_admin_services_list where smme_admin_serviceprovider.id=smme_admin_services_list.provider");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updatefixedservice($provider,$service,$id){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_services_list where provider=? and service=? and id!=?");	
$sql->execute(array($provider,$service,$id));
$rowcount=$sql->rowCount();
if($rowcount==0){
$sql=$dbh->prepare("update smme_admin_services_list set provider=?,service=? where id=?");	
$sql->execute(array($provider,$service,$id));
return 0;
}else{
return 1;	
}
}

function deletefixedservice($id){
global $dbh;
$sql=$dbh->prepare("delete from smme_admin_services_list where id=?");	
$sql->execute(array($id));
return "deleted successfully";
}

function createfixedservice($provider,$service){
global $dbh;	
$sql=$dbh->prepare("select * from smme_admin_services_list where provider=? and service=?");
$sql->execute(array($provider,$service));
if($sql->rowCount()==0){
$sql=$dbh->prepare("insert into smme_admin_services_list(`provider`,`service`)values(?,?)");
$sql->execute(array($provider,$service));
return "Service has been created";
}else{
return "1";
} 
}

}
?>