<?php require_once("common.class.php");

class profit extends common{
function getrocords($searchterms,$page,$perpage){
$pagsearch=$searchterms;	
$searchquery=explode(",",$searchterms);	
$query="";
if(isset($searchquery[0]) && $searchquery[0]!="" && isset($searchquery[1]) && $searchquery[1]!=""){
$query.=' and smme_users_order.date between "'.date("Y-m-d 00:00:00",strtotime($searchquery[0])).'" and "'.date("Y-m-d 23:59:59",strtotime($searchquery[1])).'"';
}
if(isset($searchquery[2]) && $searchquery[2]!=""){
$query.=" and smme_users_order.servicetype=".$searchquery[2];
}
if(isset($searchquery[3]) && $searchquery[3]!=""){
$query.=" and smme_users_order.smmeid=".$searchquery[3];
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$sql=$dbh->prepare("SELECT smme_users.username,smme_users_order.id,smme_users_order.count,smme_admin_services.display,smme_users_order_urls.url,smme_users_order.price,smme_users_order.oprice,smme_users_order_status.status, smme_users_order.date FROM smme_users,smme_users_order,smme_users_order_status,smme_users_order_urls,smme_admin_services WHERE smme_users.id=smme_users_order.smmeid and smme_users_order.status=smme_users_order_status.id and smme_users_order_status.status='Completed' and smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.servicetype=smme_admin_services.id ".$query." limit $start,$perpage");
$sql->execute();
$pag=$dbh->prepare("SELECT smme_users.username,smme_users_order.id,smme_users_order.count,smme_admin_services.display, smme_users_order_urls.url,smme_users_order.price,smme_users_order.oprice,smme_users_order_status.status,smme_users_order.date FROM smme_users,smme_users_order,smme_users_order_status,smme_users_order_urls,smme_admin_services WHERE smme_users.id=smme_users_order.smmeid and smme_users_order.status=smme_users_order_status.id and smme_users_order_status.status='Completed' and smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.servicetype=smme_admin_services.id  ".$query."");
$pag->execute();
$rowcount=$pag->rowCount();
$pro=$pag->fetchAll();
if($rowcount>0){
$res=$sql->fetchAll();
$pagin=$this->pagination($rowcount,$perpage,$cur_page,$pagsearch,"manageprofit");
return array($res,$pagin,$pro);
}else {
return "No Record Found";
}
}
}
?>