<?php require_once("common.class.php");
class autoorders extends common{
	
	
function getorders($searchterms,$page,$perpage){
$pagsearch=$searchterms;	
$searchquery=explode(",",$searchterms);	
$query="";
if(isset($searchquery[0]) && $searchquery[0]!=""){
$query.='and d.id="'.$searchquery[0].'"';
}
if(isset($searchquery[1]) && $searchquery[1]!=""){
$query.=" and d.iusername=".$searchquery[1];
}
if(isset($searchquery[2]) && $searchquery[2]!=""){
$query.=" and d.serviceid=".$searchquery[2];
}

if(isset($searchquery[3]) && $searchquery[3]!=""){
$query.=" and d.smmeid=".$searchquery[3];
}
if(isset($searchquery[4]) && $searchquery[4]!=""){
$query.=" and d.status='$searchquery[4]'";
}

$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$sql=$dbh->prepare("select f.email,a.status as autostatus,d.userprivatestatus,c.display,d.* from smme_users_auto_orders d,smme_admin_services c,smme_users_auto_order_status a,smme_users f
 where c.id=d.serviceid and a.id=d.status and f.id=d.smmeid ".$query." order by d.id desc limit $start,$perpage");	
$sql->execute();	
if($sql->rowCount()>0){
$res=$sql->fetchAll();	
$sql=$dbh->prepare("select f.email,a.status as autostatus,d.userprivatestatus,c.display,d.* from smme_users_auto_orders d,smme_admin_services c,smme_users_auto_order_status a,smme_users f
 where c.id=d.serviceid and a.id=d.status and f.id=d.smmeid ".$query."");	
$sql->execute();	
$totalrecords=$sql->rowCount();
$pagin=$this->pagination($totalrecords,$perpage,$cur_page,$pagsearch,"manageorder");
return array($res, $pagin);
}else {
return "No record found";
}
}	

function getpriceforservice($service,$autoorderid){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_auto_orders where id=?");
$sql->execute(array($autoorderid));
$res=$sql->fetch();
$smmeid=$res['smmeid'];

$sql=$dbh->prepare("select * from smme_users_profile where smmeid=?");
$sql->execute(array($smmeid));
$profile=$sql->fetch();


$sql=$dbh->prepare("select * from smme_admin_pricing where service=? and userid=?");
$sql->execute(array($service,$smmeid));
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
}else if($status=="Start"){
$status1=1;
}else if($status=="Cancel"){
$status1=8;
}
$ids=explode(",",$autoorderid);
foreach($ids as $id){
$sql=$dbh->prepare("select smme_users_auto_orders where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
if($res['status']!="8" && $res['status']!="6" && $res['status']!="4"){
$sql=$dbh->prepare("update smme_users_auto_orders set status=? where id=?");
$sql->execute(array($status1,$id));
}
}
}
}
?>