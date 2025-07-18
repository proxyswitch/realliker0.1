<?php require_once("common.class.php");

class usertransaction extends common{
	
function getrocords($searchterms,$page,$perpage){
	
$pagsearch=$searchterms;	
$searchquery=explode(",",$searchterms);	
$totalcamt=0;
$totaldebited=0;
global $dbh;
$query="";
if(isset($searchquery[0]) && $searchquery[0]!=""){
$query.="and smme_users.id=".$searchquery[0];
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where smmeid=? and perform=?");
$sql->execute(array($searchquery[0],"+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where smmeid=? and perform=?");
$sql->execute(array($searchquery[0],"-"));
$tres=$sql->fetch();
$totaldebited=$tres['totalamount'];
}
if(isset($searchquery[1]) && $searchquery[1]!=""){
if($searchquery[1]=="Credit"){
$search1="+";

$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where perform=?");
$sql->execute(array("+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];
$totaldebited=0;
}
else if($searchquery[1]=="Debit"){
$search1="-";
$totalcamt=0;
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where perform=?");
$sql->execute(array("-"));
$tres=$sql->fetch();
$totaldebited=$tres['totalamount'];
}
$query.=' and d.perform="'.$search1.'"';
}

if(isset($searchquery[0]) && $searchquery[0]!="" && isset($searchquery[1]) && $searchquery[1]!=""){
if($searchquery[1]=="Credit"){
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where smmeid=? and perform=?");
$sql->execute(array($searchquery[0],"+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];
$totaldebited=0;
}else {
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where smmeid=? and perform=?");
$sql->execute(array($searchquery[0],"-"));
$tres=$sql->fetch();
$totalcamt=0;
$totaldebited=$tres['totalamount'];
}
}

if($pagsearch=="")
{
$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where perform=?");
$sql->execute(array("+"));
$tres=$sql->fetch();
$totalcamt=$tres['totalamount'];

$sql=$dbh->prepare("select sum(amount) as totalamount from smme_users_transactions where perform=?");
$sql->execute(array("-"));
$tres=$sql->fetch();
$totaldebited=$tres['totalamount'];
}


$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
	
$sql=$dbh->prepare("select smme_users.username,d.* from smme_users_transactions d,smme_users where smme_users.id=d.smmeid ".$query." order by d.id desc limit $start, $perpage");
$sql->execute();
$pag=$dbh->prepare("select smme_users.username,d.* from smme_users_transactions d,smme_users where smme_users.id=d.smmeid ".$query."");
$pag->execute();
$rowcount=$pag->rowCount();
if($rowcount>0){
$res=$sql->fetchAll();
$pagin=$this->pagination($rowcount,$perpage,$cur_page,$pagsearch,"managetransaction");
return array($res,$pagin,$totalcamt,$totaldebited);
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