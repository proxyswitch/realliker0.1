<?php 

class statistics {
	

function statisticsorder($service){
global $dbh;	
if($service==""){
$sql=$dbh->prepare("select * from smme_users_order,smme_users_order_status where smme_users_order.status=smme_users_order_status.id and smme_users_order_status.status='Completed'");
$sql->execute();	
}else {
$sql=$dbh->prepare("select * from smme_users_order,smme_admin_serviceprovider,smme_users_order_status where smme_admin_serviceprovider.id=smme_users_order.service and smme_admin_serviceprovider.provider=? and smme_users_order.status=smme_users_order_status.id and  smme_users_order_status.status='Completed'");
$sql->execute(array($service));	
}	
return $sql->rowCount();	
}

function statisticsincome($service){
global $dbh;	
if($service==""){
$sql=$dbh->prepare("select SUM(price) from smme_users_order,smme_users_order_status where smme_users_order.status=smme_users_order_status.id and smme_users_order_status.status='completed'");
$sql->execute();	
}else {
$sql=$dbh->prepare("select SUM(price) from smme_users_order,smme_users_order_status,smme_admin_serviceprovider where smme_users_order.status=smme_users_order_status.id and smme_users_order.service=smme_admin_serviceprovider.id and smme_admin_serviceprovider.provider=? and smme_users_order_status.status='completed'");
$sql->execute(array($service));	
}	
$res=$sql->fetch();
return $res['SUM(price)'];	
}	
	
	
	
	
	
	
	
	
	}