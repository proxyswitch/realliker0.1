<?php ini_set('memory_limit', '128M'); require_once("common.class.php"); 

class orders extends common{
	
function getrocords($searchterms,$page,$perpage){
$pagsearch=$searchterms;	
$searchquery=explode(",",$searchterms);	
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


if(isset($searchquery[6]) && $searchquery[6]!=""){
$query.=" and smme_users_order_urls.url='$searchquery[6]'";
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$sql=$dbh->prepare("SELECT smme_users.username,smme_users.email,smme_users_order.smmeid,smme_users_order.autoorderid,smme_users_order.id,smme_users_order.apiorderid,smme_users_order.apipo,smme_users_order.txno,smme_users_order.rtxno,smme_users_order.count,smme_users_order_urls.startcount,smme_users_order_urls.finishcount,smme_admin_services.display,smme_users_order_urls.url,smme_users_order_urls.apfrom,smme_users_order_urls.extdata,smme_users_order_urls.icomments,smme_users_order.price,smme_users_transactions.bbalance, smme_users_transactions.abalance,smme_users_order_status.status,smme_users_order.date from smme_users,smme_users_order,smme_users_order_status,smme_users_transactions,smme_admin_services,smme_users_order_urls where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.id=smme_users_transactions.orderid and smme_users_transactions.perform='-' and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.smmeid=smme_users.id ".$query." order by smme_users_order.id desc limit $start, $perpage");
$sql->execute();
$res=$sql->fetchAll();
$pag=$dbh->prepare("SELECT smme_users.username,smme_users.email,smme_users_order.smmeid,smme_users_order.id,smme_users_order.autoorderid,smme_users_order.apiorderid,smme_users_order.apipo,smme_users_order.txno,smme_users_order.rtxno,smme_users_order.count,smme_users_order_urls.startcount,smme_users_order_urls.finishcount,smme_admin_services.display,smme_users_order_urls.url,smme_users_order_urls.apfrom,smme_users_order_urls.extdata,smme_users_order_urls.icomments,smme_users_order.price,smme_users_transactions.bbalance, smme_users_transactions.abalance,smme_users_order_status.status,smme_users_order.date from smme_users,smme_users_order,smme_users_order_status,smme_users_transactions,smme_admin_services,smme_users_order_urls where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.id=smme_users_transactions.orderid and smme_users_transactions.perform='-' and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.smmeid=smme_users.id ".$query."");
$pag->execute();
$counts=$pag->rowCount();
if($counts>0){
$pagin=$this->pagination($counts,$perpage,$cur_page,$pagsearch,"manageorder");	
return array($res,$pagin);
}else{
return 'No Record Found';
}
}

function getapiprovidernamebyid($id){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_api where id=?");
$sql->execute(array($id));
$res= $sql->fetch();
return $res['apiname'];	

}

function getrefundedamount($txid){

global $dbh;
$sql=$dbh->prepare("select * from smme_users_transactions where id=?");
$sql->execute(array($txid));
$res= $sql->fetch();
return $res['amount'];
}


function getorderstatusbyname($name){
global $dbh;
$sql=$dbh->prepare("select id from smme_users_order_status where status=?");
$sql->execute(array($name));
$res=$sql->fetch();
return $res['id'];	
}

function getorderstatusbyid($id){
global $dbh;
$sql=$dbh->prepare("select status from smme_users_order_status where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
return $res['status'];	
}

function singleorderdetails($id){
global $dbh;
$sql=$dbh->prepare("SELECT smme_users_order.status as orstatus,smme_users.username,smme_users.email,smme_users_order.smmeid,smme_users_order.id,smme_users_order.txno,smme_users_order.rtxno,smme_users_order.count,smme_users_order_urls.startcount,smme_users_order_urls.finishcount,smme_admin_services.display,smme_users_order_urls.url,smme_users_order.price,smme_users_transactions.bbalance, smme_users_transactions.abalance,smme_users_order_status.status,smme_users_order.date from smme_users,smme_users_order,smme_users_order_status,smme_users_transactions,smme_admin_services,smme_users_order_urls where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.id=smme_users_transactions.orderid and smme_users_transactions.perform='-' and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.smmeid=smme_users.id and smme_users_order.id=?");
$sql->execute(array($id));
$res=$sql->fetch();
return $res;
}

function getbalancebyid($smmeid){
global $dbh;
$sql=$dbh->prepare("select balance from smme_users_wallet where smmeid=?");
$sql->execute(array($smmeid));
$res=$sql->fetch();
return $res['balance'];	
}

function getorderurlbyorderid($orderid){
global $dbh;
$sql=$dbh->prepare("select url from smme_users_order_urls where orderid=?");
$sql->execute(array($orderid));
$res=$sql->fetch();
return $res['url'];	
}

function orderdetailsforrecreation($orderid){
global $dbh;
$sql=$dbh->prepare("select c.*,d.* from smme_users_order c,smme_users_order_urls d where c.id=d.orderid and c.id=?");
$sql->execute(array($orderid));
return $sql->fetch();
}

function getusertransactiondetailsbyid($txid){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_transactions where id=?");
$sql->execute(array($txid));
$res=$sql->fetch();
return $res['amount'];		
}

function recreateorderbyadmin($id,$status,$ostatus){
global $dbh;
$previousdetails=$this->orderdetailsforrecreation($id);
$previousurl=$this->getorderurlbyorderid($id);
if($ostatus=="Completed"){
$finishcount=$previousdetails['startcount']+$previousdetails['count'];
$noti=1;	
}else{
$finishcount=$previousdetails['startcount'];
$noti=0;
}
$beforebalance=$this->getbalancebyid($previousdetails['smmeid']);
$price=$this->getusertransactiondetailsbyid($previousdetails['rtxno']);
$afterbalance=$beforebalance-$price;
if($beforebalance>=$price){
$sql=$dbh->prepare("INSERT INTO `smme_users_order`(smmeid,servicetype,price,oprice,status,count,ipaddress,service,byprice,sprice,scount,regenid,usernoti)
VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?,?,?);");
$sql->execute(array($previousdetails['smmeid'],$previousdetails['servicetype'],$previousdetails['price'],$previousdetails['oprice'],$status,$previousdetails['count'],$_SERVER['REMOTE_ADDR'],$previousdetails['service'],$previousdetails['byprice'],$previousdetails['sprice'],$previousdetails['scount'],$id,$noti));
$neworderid=$dbh->lastInsertId();
$sql12=$dbh->prepare("insert into smme_users_order_urls (`orderid`,`smmeid`,`url`,`startcount`,`finishcount`)values(?,?,?,?,?)");
$sql12->execute(array($neworderid,$previousdetails['smmeid'],$previousurl,$previousdetails['startcount'],$finishcount));
$sql1=$dbh->prepare("insert into smme_users_transactions (`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`)values(?,?,?,?,?,?,?)");
$sql1->execute(array($previousdetails['smmeid'],$beforebalance,$price,$afterbalance,'-',$_SERVER['REMOTE_ADDR'],$neworderid));
$txid=$dbh->lastInsertId();
$txupdate=$dbh->prepare("UPDATE smme_users_order set txno=?,canceltxid=? where id=?");
$txupdate->execute(array($txid,$previousdetails['txno'],$neworderid));
$bupdate=$dbh->prepare("UPDATE smme_users_wallet set balance=? where smmeid=?");
$bupdate->execute(array($afterbalance,$previousdetails['smmeid']));
}
}

function changestatus($ids,$ostatus){
global $dbh;
$ids=explode(",",$ids);
$statusid=$this->getorderstatusbyname($ostatus);
foreach($ids as $id){
$previousdetails=$this->singleorderdetails($id);
if($ostatus=="Refunded" && $previousdetails['rtxno']==0){
$refundamt=$previousdetails['price'];
$sql=$dbh->prepare("select balance from smme_users_wallet where smmeid=?");
$sql->execute(array($previousdetails['smmeid']));
$profiled=$sql->fetch();
$previousamount=$profiled['balance'];
$newbalance=$previousamount+$refundamt;
$sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`,`usernoti`) values(?,?,?,?,?,?,?,?)");
$sql->execute(array($previousdetails['smmeid'],$previousamount,$refundamt,$newbalance,'+',$_SERVER['REMOTE_ADDR'],$id,1));
$refundtxno=$dbh->lastInsertId();
$sql=$dbh->prepare("update smme_users_order set rtxno=?,status=? where id=?");
$sql->execute(array($refundtxno,$statusid,$id));
$sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
$sql->execute(array($newbalance,$previousdetails['smmeid']));
}else if($previousdetails['orstatus']==5 && $previousdetails['rtxno']!=0 && $statusid!=5){
$this->recreateorderbyadmin($id,$statusid,$ostatus);
}else if($ostatus=="Completed"){
$finishcount=$previousdetails['startcount']+$previousdetails['count'];	
$sql=$dbh->prepare("update smme_users_order set ftime=?,status=?,usernoti=? where id=?");
$sql->execute(array(date("Y-m-d h:i:s"),$statusid,1,$id));
$sql=$dbh->prepare("update smme_users_order_urls set finishcount=? where orderid=?");
$sql->execute(array($finishcount,$id));
}else if($ostatus=="Processing" || $ostatus=="Proceed"){
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($statusid,$id));
}
}
}
function deleteorder($ids){
global $dbh;	
$ids=explode(",",$ids);
foreach($ids as $id){
$sql=$dbh->prepare("delete from smme_users_order where id=?");
$sql->execute(array($id));
$sql=$dbh->prepare("delete from smme_users_order_urls where orderid=?");
$sql->execute(array($id));
}
return "Deleted Successfully";
}


function singleorderupdate($id,$url,$ostatus,$refundamt,$startcount,$finishcount,$refundreason){
global $dbh;
$status=$this->getorderstatusbyid($ostatus);
$previousdetails=$this->singleorderdetails($id);
if($status=="Refunded" && $previousdetails['refundtxno']==0){
if($refundamt!=""){
$refundamt=$refundamt;
}else{
$refundamt=$previousdetails['price'];
}
$sql=$dbh->prepare("select balance from smme_users_wallet where smmeid=?");
$sql->execute(array($previousdetails['smmeid']));
$profiled=$sql->fetch();
$previousamount=$profiled['balance'];
$newbalance=$previousamount+$refundamt;
$sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`,`usernoti`) values(?,?,?,?,?,?,?,?)");
$sql->execute(array($previousdetails['smmeid'],$previousamount,$refundamt,$newbalance,'+',$_SERVER['REMOTE_ADDR'],$id,1));
$refundtxno=$dbh->lastInsertId();
$sql=$dbh->prepare("update smme_users_order set rtxno=?,status=? where id=?");
$sql->execute(array($refundtxno,$ostatus,$id));

$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($startcount,$finishcount,$id));

$sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
$sql->execute(array($newbalance,$previousdetails['smmeid']));
}
else if($previousdetails['status']==5 && $previousdetails['rtxno']!=0 && $ostatus!=5){
$this->recreateorderbyadmin($id,$ostatus,$status);
}else if($status=="Completed"){
$finishcount=$previousdetails['startcount']+$previousdetails['count'];	
$sql=$dbh->prepare("update smme_users_order set status=?,usernoti=? where id=?");
$sql->execute(array($ostatus,1,$id));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($startcount,$finishcount,$id));
}else if($status=="Pending" || $status=="Processing" || $status=="Proceed" || $status=="Error"){
$sql=$dbh->prepare("update smme_users_order set status=? where id=?");
$sql->execute(array($ostatus,$id));
$sql=$dbh->prepare("update smme_users_order_urls set startcount=?,finishcount=? where orderid=?");
$sql->execute(array($startcount,$finishcount,$id));
}
$sql=$dbh->prepare("update smme_users_order_urls set url=?,refundreason=? where orderid=?");
$sql->execute(array($url,$refundreason,$id));
}
}
?>