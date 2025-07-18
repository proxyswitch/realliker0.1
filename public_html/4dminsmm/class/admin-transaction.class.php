<?php require_once("common.class.php");

class admintransaction extends common{
	
function getrocords($searchterms,$page,$perpage){
global $dbh;
$pagsearch=$searchterms;	
$searchquery=explode(",",$searchterms);	
$totalcamt=0;
$totalcamtdebit=0;
$query="";
if(isset($searchquery[0]) && $searchquery[0]!=""){
$query="and smme_admin_transaction.smmeid=".$searchquery[0];
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where smmeid=? and operation=?");
$sql->execute(array($searchquery[0],"+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where smmeid=? and operation=?");
$sql->execute(array($searchquery[0],"-"));
$tres=$sql->fetch();
$totalcamtdebit=$tres['totalamount'];
}
if(isset($searchquery[1]) && $searchquery[1]!=""){
if($searchquery[1]=="Credit"){
$search1="+";
$query=' and smme_admin_transaction.operation="'.$search1.'"';
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where operation=?");
$sql->execute(array("+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];
$totalcamtdebit=0;
}
else if($searchquery[1]=="Debit"){
$search1="-";
$query=' and smme_admin_transaction.operation="'.$search1.'"';
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where operation=?");
$sql->execute(array("-"));
$tres=$sql->fetch();
$totalcamtdebit=$tres['totalamount'];
$totalcamt=0;
}
}

if(isset($searchquery[0]) && $searchquery[0]!="" && isset($searchquery[1]) && $searchquery[1]!=""){
if($searchquery[1]=="Credit"){
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where smmeid=? and operation=?");
$sql->execute(array($searchquery[0],"+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];
$totalcamtdebit=0;
}else if($searchquery[1]=="Debit"){
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where smmeid=? and operation=?");
$sql->execute(array($searchquery[0],"-"));
$tres=$sql->fetch();
$totalcamtdebit=$tres['totalamount'];
$totalcamt=0;
}
}
if($pagsearch=="")
{
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where operation=?");
$sql->execute(array("+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_admin_transaction where operation=?");
$sql->execute(array("-"));
$tres=$sql->fetch();
$totalcamtdebit=$tres['totalamount'];
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
$sql=$dbh->prepare("select smme_users.username,smme_admin_transaction.id as roteid,smme_admin_transaction.smmeid,smme_admin_transaction.txid,smme_admin_transaction.amount,smme_admin_transaction.reason,smme_admin_transaction.payer_email,smme_admin_transaction.receiver_email,smme_admin_transaction.date,smme_admin_transaction.opfrom,smme_admin_transaction.ipaddress from smme_users,smme_admin_transaction where smme_users.id=smme_admin_transaction.smmeid ".$query." order by smme_admin_transaction.id desc limit $start, $perpage");
$sql->execute();
$pag=$dbh->prepare("select smme_users.username,smme_admin_transaction.id as roteid,smme_admin_transaction.smmeid,smme_admin_transaction.txid,smme_admin_transaction.amount,smme_admin_transaction.reason,smme_admin_transaction.payer_email,smme_admin_transaction.receiver_email,smme_admin_transaction.date,smme_admin_transaction.opfrom,smme_admin_transaction.ipaddress from smme_users,smme_admin_transaction where smme_users.id=smme_admin_transaction.smmeid ".$query."");
$pag->execute();
$rowcount=$pag->rowCount();
$pro=$pag->fetchAll();
if($rowcount>0){
$res=$sql->fetchAll();
$pagin=$this->pagination($rowcount,$perpage,$cur_page,$pagsearch,"managetransaction");
return array($res,$pagin,$totalcamt,$totalcamtdebit);
}else {
return "No Record Found";
}
}


function getordertransactionitem($id){
global $dbh;
$sql=$dbh->prepare("select smme_users.count,smme_users_order_urls.refundreason,smme_admin_services.display,smme_users_order.txno from smme_users_order,smme_users_order_urls,smme_admin_services where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.id=?");
$sql->execute(array($id));	
$res=$sql->fetch();
return $res;
}

function getadmintransactionitem($admintxid){
global $dbh;
$sql=$dbh->prepare("select reason from smme_admin_transaction where id=?");
$sql->execute(array($admintxid));
$res=$sql->fetch();
return $res['reason'];
}

}
?>