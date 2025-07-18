<?php require_once("common.class.php");

class downloads extends common{
	
function downloadexcel($searchquery){
global $dbh;
$query="";
if(isset($searchquery[0]) && $searchquery[0]!=""){
$query.='and (smme_users_order.id="'.$searchquery[0].'" OR smme_users_order_urls.url LIKE "%'.$searchquery[0].'%")';
}
if(isset($searchquery[1]) && $searchquery[1]!="" && isset($searchquery[2]) && $searchquery[2]!=""){
$query.=' and smme_users_order.date between "'.date("Y-m-d 00:00:00",strtotime($searchquery[1])).'" and "'.date("Y-m-d 23:59:59",strtotime($searchquery[2])).'"';
}
if(isset($searchquery[3]) && $searchquery[3]!=""){
$query.=" and smme_users_order.servicetype=".$searchquery[3];
}

if(isset($searchquery[4]) && $searchquery[4]!=""){
$query.=" and smme_users_order.smmeid=".$searchquery[4];
}

if(isset($searchquery[5]) && $searchquery[5]!=""){
$query.=" and smme_users_order.status=".$searchquery[5];
}
$sql=$dbh->prepare("SELECT smme_users.username,smme_users_order.id,smme_admin_services.display,smme_users_order_urls.url,smme_users_order.count,smme_users_order.count+smme_users_order_urls.startcount-smme_users_order_urls.finishcount as finishcount,smme_users_order.price,smme_users_transactions.bbalance,smme_users_transactions.abalance,smme_users_order_status.status,smme_users_order.date,smme_users_order.txno,smme_users_order.rtxno FROM smme_users,smme_users_order,smme_users_order_urls,smme_admin_services,smme_users_transactions,smme_users_order_status where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.id=smme_users_transactions.orderid and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.smmeid=smme_users.id and smme_users_transactions.perform='-' ".$query." order by smme_users_order.id asc"); 
$sql->execute();
$res=$sql->fetchAll(PDO::FETCH_NUM);
return $res;
}
	
	
	
	
	
	

function downloadtext($searchquery){
global $dbh;
$query="";
if(isset($searchquery[0]) && $searchquery[0]!=""){
$query.='and (smme_users_order.id="'.$searchquery[0].'" OR smme_users_order_urls.url LIKE "%'.$searchquery[0].'%")';
}
if(isset($searchquery[1]) && $searchquery[1]!="" && isset($searchquery[2]) && $searchquery[2]!=""){
$query.=' and smme_users_order.date between "'.date("Y-m-d 00:00:00",strtotime($searchquery[1])).'" and "'.date("Y-m-d 23:59:59",strtotime($searchquery[2])).'"';
}
if(isset($searchquery[3]) && $searchquery[3]!=""){
$query.=" and smme_users_order.servicetype=".$searchquery[3];
}
if(isset($searchquery[4]) && $searchquery[4]!=""){
$query.=" and smme_users_order.smmeid=".$searchquery[4];
}
if(isset($searchquery[5]) && $searchquery[5]!=""){
$query.=" and smme_users_order.status=".$searchquery[5];
}
$sql=$dbh->prepare("SELECT smme_users_order_urls.url,smme_users_order.count FROM smme_users_order,smme_users_order_urls WHERE smme_users_order.id=smme_users_order_urls.orderid ".$query." order by smme_users_order.id ASC"); 
$sql->execute();
$res=$sql->fetchAll();
return $res;	
}	

	
}
?>