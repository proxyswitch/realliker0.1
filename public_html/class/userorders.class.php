<?php require_once("userprofile.class.php");
class orders extends profile{
	
function getstatusid($status){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_order_status where status=?");
$sql->execute(array($status));
$res=$sql->fetch();
return $res['id'];
}	
	
function getorders($search,$page,$perpage){
$searchquery=explode(",",$search);
$searchby="";
if(isset($searchquery[0]) && $searchquery[0]!=""){
$searchby.=' and (smme_users_order.id="'.$searchquery[0].'" OR smme_users_order_urls.url LIKE "%'.$searchquery[0].'%")';	
}
if(isset($searchquery[1]) && $searchquery[1]!=""){
$status=$this->getstatusid($searchquery[1]);	
$searchby.=" and smme_users_order.status=".$status;	
}
if(isset($searchquery[2]) && $searchquery[2]!=""){
$searchby.=" and smme_users_order_urls.url='$searchquery[2]'";		
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select smme_users_order.id,smme_users_order.price,smme_users_order.date,smme_users_order.autoorderid,smme_users_order.ftime,smme_users_order.count,smme_users_order_urls.startcount,smme_users_order_urls.finishcount,smme_users_order_urls.url,smme_users_order_urls.refundreason,smme_users_order_urls.extdata,smme_users_order_urls.icomments,smme_users_order_status.status,smme_admin_services.display from smme_users_order,smme_users_order_status,smme_users_order_urls,smme_admin_services where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.smmeid=? ".$searchby." order by smme_users_order.id desc limit $start,$perpage");	
$sql->execute(array($userid));	
if($sql->rowCount()>0){
$res=$sql->fetchAll();	
$sql=$dbh->prepare("select smme_users_order.id,smme_users_order.price,smme_users_order.date,smme_users_order.autoorderid,smme_users_order.ftime,smme_users_order.count,smme_users_order_urls.startcount,smme_users_order_urls.finishcount,smme_users_order_urls.url,smme_users_order_urls.refundreason,smme_users_order_status.status,smme_admin_services.display from smme_users_order,smme_users_order_status,smme_users_order_urls,smme_admin_services where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.smmeid=? ".$searchby."");	
$sql->execute(array($userid));	
$totalrecords=$sql->rowCount();
$pagin=$this->pagination($totalrecords,$perpage,$cur_page,$search);
return array($res, $pagin);
}else {
return "No record found";
}
}	
}
?>