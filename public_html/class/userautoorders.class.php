<?php require_once("userprofile.class.php");
class autoorders extends profile{
	
	
function getorders($searchquery,$page,$perpage){
$searchby="";
if(isset($searchquery) && $searchquery!=""){
$searchby.="and d.iusername='$searchquery'";		
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select a.status as autostatus,d.userprivatestatus,c.display,d.* from smme_users_auto_orders d,smme_admin_services c,smme_users_auto_order_status a
 where c.id=d.serviceid and a.id=d.status and smmeid=? ".$searchby." order by d.id desc limit $start,$perpage");	
$sql->execute(array($userid));	
if($sql->rowCount()>0){
$res=$sql->fetchAll();	
$sql=$dbh->prepare("select a.status as autostatus,d.userprivatestatus,c.display,d.* from smme_users_auto_orders d,smme_admin_services c,smme_users_auto_order_status a
 where c.id=d.serviceid and a.id=d.status and smmeid=? ".$searchby."");	
$sql->execute(array($userid));	
$totalrecords=$sql->rowCount();
$pagin=$this->pagination($totalrecords,$perpage,$cur_page,$search);
return array($res, $pagin);
}else {
return "No record found";
}
}	

function getpriceforservice($service){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$sql=$dbh->prepare("select * from smme_admin_pricing where service=? and userid=?");
$sql->execute(array($service,$profile['smmeid']));
if($sql->rowcount()>0){
$res=$sql->fetch();
}else {
$sql=$dbh->prepare("select * from smme_admin_pricing where service=? and userid=? and user_group=?");
$sql->execute(array($service,0,$profile['groups']));
$res=$sql->fetch();
}
return array($res['sellprice'],$res['per_item']);


}

function getnoorderbyautoorder($autoorderid){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_order where autoorderid=?");
$sql->execute(array($autoorderid));
return $sql->rowCount();
}

function changeautostatus123($autoorderid,$status){
global $dbh;
if($status=="Pause"){
$status1=7;
}else{
$status1=1;
}
$sql=$dbh->prepare("update smme_users_auto_orders set status=?,lastchecked=? where id=?");
$sql->execute(array($status1,time(),$autoorderid));
}


}
?>