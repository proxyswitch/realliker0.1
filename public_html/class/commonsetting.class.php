<?php require_once("userprofile.class.php");
class common extends profile{
public function __construct(){
if(!isset($_SESSION['smmebhaveshsitelike']) && $_SESSION['smmebhaveshsitelike']==""){
header("location:index.php");	
}
}
	
function getservicedetailsbyname($service){
global $dbh;
$sql=$dbh->prepare("select smme_admin_serviceprovider.provider,d.* from smme_admin_serviceprovider,smme_admin_services d where smme_admin_serviceprovider.id=d.site and smme_admin_serviceprovider.provider=? and d.autoorder=? and d.status='Active' order by d.newstatus desc,d.id asc");
$sql->execute(array($service,0));
$res=$sql->fetchall();
return $res;
}

function getautoorderservicedetailsbyname($service){
global $dbh;
$sql=$dbh->prepare("SELECT d.* FROM smme_admin_serviceprovider p,smme_admin_services d,smme_admin_services_list c WHERE p.id=d.site AND p.provider=? AND p.id=c.provider
AND c.service NOT LIKE  'Follower%' AND c.id=d.service and d.autoorder=? AND d.status='Active' order by d.newstatus desc,d.id asc" );
$sql->execute(array($service,1));
$res=$sql->fetchall();
return $res;
}


	
function getservicedetails($service){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$sql=$dbh->prepare("select * from smme_admin_pricing where service=? and userid=?");
$sql->execute(array($service,$profile['smmeid']));
if($sql->rowcount()>0){
$res=$sql->fetch();
}else {
$sql=$dbh->prepare("select * from smme_admin_pricing where service=? and userid=? and user_group=?");
$sql->execute(array($service,0,$profile['groups']));
$res=$sql->fetch();
}
return $res['sellprice']."@#$".$res['per_item']."@#$".$res['min_order']."@#$".$res['max_order'];
}	

function getservicepricedetails($service){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$sql=$dbh->prepare("select * from smme_admin_pricing where service=? and userid=?");
$sql->execute(array($service,$profile['smmeid']));
if($sql->rowcount()>0){
$res=$sql->fetch();
}else {
$sql=$dbh->prepare("select * from smme_admin_pricing where service=? and userid=? and user_group=?");
$sql->execute(array($service,0,$profile['groups']));	
$res=$sql->fetch();
}
return $res;
}	


function pricelist($provider){
global $dbh;
$sql1=$dbh->prepare("select * from smme_admin_services where site=? and status='Active'");
$sql1->execute(array($provider));
$servicelist=$sql1->fetchAll();
foreach($servicelist as $list){
$pricedetails=$this->getservicepricedetails($list['id']);
echo "<tr><td class='sdisplay'>".str_replace("(","<br/>(",$list['display'])."</td><td>".$pricedetails['sellprice']."$/".$pricedetails['per_item']."</td><td>".$pricedetails['min_order']."</td><td>".$pricedetails['max_order']."</td></tr>";
}
}


function smmproviders(){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_serviceprovider");
$sql->execute();
$res=$sql->fetchAll();
return $res;
}	

function orderstatuslist(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_order_status");
$sql->execute();
$res=$sql->fetchAll();
return $res;	
}

}