<?php require_once("common.class.php");

class adminservice extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
$query="";
if($searchterms!=""){
$query="and smme_admin_serviceprovider.id='$searchterms'";    
}

global $dbh;	 
$sql=$dbh->prepare("select smme_admin_serviceprovider.provider,smme_admin_services_list.id,smme_admin_services_list.service,smme_admin_services.display,smme_admin_services.site,smme_admin_services.status,smme_admin_services.created_date,smme_admin_services.autoorder,smme_admin_services.updated_date,smme_admin_services.id from smme_admin_serviceprovider,smme_admin_services_list,smme_admin_services where smme_admin_serviceprovider.id=smme_admin_services_list.provider and smme_admin_services_list.id=smme_admin_services.service $query order by smme_admin_services_list.id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select smme_admin_serviceprovider.provider,smme_admin_services_list.id,smme_admin_services_list.service,smme_admin_services.display,smme_admin_services.site,smme_admin_services.status,smme_admin_services.created_date,smme_admin_services.autoorder,smme_admin_services.updated_date,smme_admin_services.id from smme_admin_serviceprovider,smme_admin_services_list,smme_admin_services where smme_admin_serviceprovider.id=smme_admin_services_list.provider and smme_admin_services_list.id=smme_admin_services.service $query");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,$searchterms,"managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function selectservice($service){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_services where id=?");
$sql->execute(array($service));
$res=$sql->fetch();
return $res;
}

function servicelistbyprovider($provider){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_services_list where provider=?");
$sql->execute(array($provider));
$res=$sql->fetchAll();
return $res;
}

function getpricedetails($service){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_pricing where service=?");
$sql->execute(array($service));
$res=$sql->fetchAll();	
return $res;
}

function selectusergroup($user){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_profile where smmeid=?");	
$sql->execute(array($user));	
$res=$sql->fetch();
return $res;
}

function createservice($display,$provider,$service,$status,$apiprovider,$autoorder,$newstatus){
global $dbh;
$sql=$dbh->prepare("insert into smme_admin_services (display,site,service,status,created_date,api,autoorder,newstatus) values(?,?,?,?,NOW(),?,?,?)");	
$sql->execute(array($display,$provider,$service,$status,$apiprovider,$autoorder,$newstatus));	
return  $insertid=$dbh->lastInsertId();	
}

function addprice($service,$site,$serviceid,$userid,$user_group,$buyprice,$sellprice,$per_item,$min_order,$max_order){
global $dbh;
$sql=$dbh->prepare("insert into smme_admin_pricing(service,site,serviceid,userid,user_group,buyprice,sellprice,per_item,min_order,max_order)values(?,?,?,?,?,?,?,?,?,?)");	
$sql->execute(array($service,$site,$serviceid,$userid,$user_group,$buyprice,$sellprice,$per_item,$min_order,$max_order));	
}	

function deleteservice($service){
echo $service;	
global $dbh;
$sql=$dbh->prepare("delete from smme_admin_services where id=?");	
$sql->execute(array($service));	
$sql=$dbh->prepare("delete from smme_admin_pricing where service=?");	
$sql->execute(array($service));	
}

function updateservicetbl($display,$provider,$service,$status,$id,$apiprovider,$autoorder,$newstatus){
global $dbh;
$sql=$dbh->prepare("update smme_admin_services set display=?,site=?,service=?,status=?,updated_date=NOW(),api=?,autoorder=?,newstatus=? where id=?");	
$sql->execute(array($display,$provider,$service,$status,$apiprovider,$autoorder,$newstatus,$id));	
}

function deletepricebyservice($id){
global $dbh;
$sql=$dbh->prepare("delete from smme_admin_pricing where service=?");	
$sql->execute(array($id));	
}	



}
?>