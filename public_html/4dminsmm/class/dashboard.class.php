<?php require_once("common.class.php");
class dashboard extends common{
function review($case){
global $dbh;
switch($case){
case "totalusers":
$sql=$dbh->prepare("select * from smme_users");
$sql->execute();
return $sql->rowCount();
break;
case "disabledusers":
$sql=$dbh->prepare("select * from smme_users where status=?");
$sql->execute(array(1));
return $sql->rowCount();
break;

case "verifiedusers":
$sql=$dbh->prepare("select * from smme_users where verified=?");
$sql->execute(array(1));
return $sql->rowCount();
break;

case "bannedips":
$sql=$dbh->prepare("select * from smme_ip_ban_list");
$sql->execute(array(1));
return $sql->rowCount();
break;

case "yesterdaylogged":
$sql=$dbh->prepare("select * from smme_users_login_histroy where date=?");
$sql->execute(array(date("Y-m-d",strtotime("-1 day"))));
return $sql->rowCount();
break;

case "todaylogged":
$sql=$dbh->prepare("select * from smme_users_login_histroy where date=?");
$sql->execute(array(date("Y-m-d")));
return $sql->rowCount();
break;

case "failedattempts":
$sql=$dbh->prepare("select * from smme_users_login_failed");
$sql->execute();
return $sql->rowCount();
break;

case "todayfailedattempts":
$sql=$dbh->prepare("select * from smme_users_login_failed where date=?");
$sql->execute(array(date("Y-m-d")));
return $sql->rowCount();
break;


case "totalbalance":
$sql=$dbh->prepare("select sum(balance) as totalbalance from smme_users_wallet");
$sql->execute();
$res=$sql->fetch();
return round($res['totalbalance']);
break;


case "yesterdayorders":
$sql=$dbh->prepare("select * from smme_users_order where searchdate=?");
$sql->execute(array(date("Y-m-d",strtotime("-1 day"))));
return $sql->rowCount();
break;

case "todayorders":
$sql=$dbh->prepare("select * from smme_users_order where searchdate=?");
$sql->execute(array(date("Y-m-d")));
return $sql->rowCount();
break;

case "newusers":
$sql=$dbh->prepare("select * from smme_users where searchdate=?");
$sql->execute(array(date("Y-m-d")));
return $sql->rowCount();
break;

case "todaypaypal":
$sql=$dbh->prepare("select * from smme_admin_transaction where from=? and searchdate=?");
$sql->execute(array("Paypal",date("Y-m-d")));
return $sql->rowCount();
break;



}	
}	
	
}
?>