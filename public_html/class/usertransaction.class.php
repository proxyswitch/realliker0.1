<?php require_once("userprofile.class.php");
class transaction extends profile{
	
function getpaymentorderdetails($id){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select smme_users_order.count,smme_admin_services.display,smme_users_order_urls.refundreason,smme_users_order.txno from smme_users_order,smme_admin_services,smme_users_order_urls where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.id=? and smme_users_order.smmeid=?");
$sql->execute(array($id,$userid));
$res=$sql->fetch();
return $res;
}


function getadmintransactionitem($admintxid){
global $dbh;
$sql=$dbh->prepare("select reason,txid from smme_admin_transaction where id=?");
$sql->execute(array($admintxid));
$res=$sql->fetch();
return $res['reason'];
}	
	
	
	
	
function usertransaction($page,$perpage){
$searchterm="";	
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;		
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select * from smme_users_transactions where smmeid=? order by id desc limit $start,$perpage");	
$sql->execute(array($userid));	
if($sql->rowCount()>0){
$res=$sql->fetchAll();	
$sql=$dbh->prepare("SELECT COUNT(*) AS count from smme_users_transactions where smmeid=?");	
$sql->execute(array($userid));	
$totalrecords=$sql->fetch();
$pagin=$this->pagination($totalrecords['count'],$perpage,$cur_page,$searchterm);
return array($res, $pagin);	
}else {
return "No record found";
}
}	

}
?>