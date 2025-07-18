<?php require_once("../config/smmeconfig.php");
class smmetrackorder{
function orderdetails($orderno,$email){
global $dbh;
$sql=$dbh->prepare("select smme_users_order.id,smme_users_order.price,smme_users_order.date,smme_users_order.ftime,smme_users_order.count,smme_users_order_urls.startcount,smme_users_order_urls.finishcount,smme_users_order_urls.url,smme_users_order_urls.refundreason,smme_users_order_status.status,smme_admin_services.display from smme_users_order,smme_users_order_status,smme_users_order_urls,smme_admin_services,smme_users where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users.email=? and smme_users_order.id=?");	
$sql->execute(array($email,$orderno));
if($sql->rowCount()==1){
$res=$sql->fetch();	
$msg='<table class="table">
<tr><th>Order No</th><th>Url / UserName</th><th>Status</th></tr>
<tr><td>'.$res['id'].'</td><td>'.$res['url'].'</td><td>'.$res['status'].'</td></tr></table>';
return 	$msg;
}else {
return "You didn't authorized to view please contact support team!";	
}
}	
}