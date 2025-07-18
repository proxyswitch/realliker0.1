<?php include("smmeconfig.php");
require_once("getservicecountapi.php");
class apiclass{
	
function ipblocklist($ip){
global $dbh;
$sql=$dbh->prepare("select * from smme_ip_ban_list where ipaddress=?");
$sql->execute(array($ip));	
if($sql->rowCount()>0){
return 1;	
}else {
return 0;	
}	
}	

function checkapidetails($email,$scode,$key){
global $dbh;
$sql=$dbh->prepare("select a.*,u.* from smme_users_api a,smme_users u where a.smmeid=u.id and u.email=? and a.secrecode=? and a.api=? and a.status=?");
$sql->execute(array($email,$scode,$key,1));
if($sql->rowCount()==1){
return 1;	
}else {
return 0;	
}	
}


function addipblocklist($ip){
global $dbh;
$sql=$dbh->prepare("select * from smme_ip_ban_list where ipaddress=?");
$sql->execute(array($ip));	
if($sql->rowCount()>0){
return 1;	
}else {
$sql=$dbh->prepare("insert into smme_ip_ban_list (`ipaddress`,`from`)values(?,?)");
$sql->execute(array($ip,3));		
return 0;	
}	
}	

function addwrongdetails($email,$scode,$key){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_api_failed_request where email=? or ipaddress=?");
$sql->execute($email,$_SERVER['REMOTE_ADDR']);
if($sql->rowCount()<5){
$sql=$dbh->prepare("insert into smme_users_api_failed_request (`scode`,`key`,`email`,`ipaddress`)values(?,?,?,?)");
$sql->execute(array($scode,$key,$email,$_SERVER['REMOTE_ADDR']));
}else{
$this->addipblocklist($_SERVER['REMOTE_ADDR']);
}
}

function makeorder($email,$scode,$key,$service,$type,$count,$data){
global $dbh;	
$logincheck=$this->checkapidetails($email,$scode,$key);	
if($logincheck==1){
$response=$this->createorder($email,$scode,$key,$service,$type,$count,$data);	
}else {
$this->addwrongdetails($email,$scode,$key);	
}
return $response;
}

function profiledetails($email){
global $dbh;
$sql=$dbh->prepare("SELECT id FROM smme_users WHERE username=? or email=?");
$sql->execute(array($email,$email));
$login=$sql->fetch();
$sql=$dbh->prepare("SELECT smme_users.username,smme_users.email,smme_users.date,smme_users.verified,smme_users.disclaimer,smme_users_wallet.balance,d.* FROM smme_users,smme_users_wallet,smme_users_profile d WHERE smme_users.id=d.smmeid and d.smmeid=smme_users_wallet.smmeid and smme_users.id=?");
$sql->execute(array($login['id']));
$profile=$sql->fetch();
return $profile;
}

function calculatePrice($orderCount, $servicePrice, $servicePricePerItem)
{
$orderCountSlice = $orderCount/$servicePricePerItem;
$intOrderCountSlice =round($orderCountSlice);
if($orderCountSlice < 1 && $orderCountSlice > 0)
{
$intOrderCountSlice = 1;
}
else if($intOrderCountSlice < $orderCountSlice)
{
$intOrderCountSlice = $intOrderCountSlice + 1;
}
$price = ($intOrderCountSlice * $servicePrice);
return number_format((float)$price, 2, '.', '');
}

function getcustomerprice($service,$count,$userid,$usergroup){
global $dbh;
$sql=$dbh->prepare("SELECT d.*,smme_admin_services.id as displayid,smme_admin_services.site,smme_admin_services_list.service AS ser FROM smme_admin_pricing d,smme_admin_services ,smme_admin_services_list where d.service=smme_admin_services.id and d.serviceid=smme_admin_services_list.id and d.service=? and d.userid=? and d.user_group=?"); 
$sql->execute(array($service,$userid,$usergroup));
if($sql->rowCount()>0){
$res=$sql->fetch();
$buyprice=$res['buyprice'];
$sellprice=$res['sellprice'];
$peritem=$res['per_item'];
$doservice=$res['ser'];
$type=$res['displayid'];
$totalprice=$this->calculatePrice($count,$sellprice,$peritem);
$saleprice=$this->calculatePrice($count,$buyprice,$peritem);
}else {
$sql=$dbh->prepare("SELECT d.*,smme_admin_services.id as displayid,smme_admin_services.site,smme_admin_services_list.service AS ser FROM smme_admin_pricing d,smme_admin_services ,smme_admin_services_list where d.service=smme_admin_services.id and d.serviceid=smme_admin_services_list.id and d.service=? and d.userid=? and d.user_group=?");
$sql->execute(array($service,0,$usergroup));	
$res=$sql->fetch(); 
$buyprice=$res['buyprice'];
$sellprice=$res['sellprice'];
$peritem=$res['per_item'];
$type=$res['displayid'];
$doservice=$res['ser'];
$totalprice=$this->calculatePrice($count,$sellprice,$peritem);
$saleprice=$this->calculatePrice($count,$buyprice,$peritem);
}
$ad=array("totalprice"=>$totalprice,"saleprice"=>$saleprice);
$res=array_merge($ad,$res);
return $res;
}

function checkbalance($currentbalance,$totalprice){
if($currentbalance=='0' || $currentbalance<0 || $currentbalance<$totalprice){
return false;
}else {
return true;
}
}	

function storeorder($case,$id,$orderid,$type,$price,$orginalprice,$beforebalance,$afterbalance,$ipaddress,$service,$date,$saleprice,$sellprice,$peritem,$reqcounts,$startcount,$url){
global $dbh;
$sql=$dbh->prepare("select id from smme_admin_serviceprovider where provider=?");
$sql->execute(array($service));
$getservice=$sql->fetch();
$service=$getservice['id'];
$sql=$dbh->prepare("INSERT INTO `smme_users_order` (smmeid,servicetype,price,oprice,ipaddress,service,byprice,sprice,scount,count,status,searchdate) VALUES (?,?, ?, ?, ?, ?, ?,?, ?, ?, ?,?);");
if($sql->execute(array($id,$type,$price,$orginalprice,$ipaddress,$service,$saleprice,$sellprice,$peritem,$reqcounts,1,date("Y-m-d")))){
$neworderid=$dbh->lastInsertId();
$sql12=$dbh->prepare("insert into smme_users_order_urls(`orderid`,`smmeid`,`url`,`startcount`,`finishcount`,`apfrom`)values(?,?,?,?,?,?)");
if($sql12->execute(array($neworderid,$id,$url,$startcount,$startcount,1))){
$sql1=$dbh->prepare("insert into smme_users_transactions (`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`)values(?,?,?,?,?,?,?)");
if($sql1->execute(array($id,$beforebalance,$price,$afterbalance,'-',$_SERVER['REMOTE_ADDR'],$neworderid))){
$txid=$dbh->lastInsertId();
$txupdate=$dbh->prepare("UPDATE smme_users_order set txno=? where id=?");
if($txupdate->execute(array($txid,$neworderid))){
$bupdate=$dbh->prepare("UPDATE smme_users_wallet set balance=? where smmeid=?");
$bupdate->execute(array($afterbalance,$id));
return array(true,$neworderid,$url,$startcount,$startcount,"Pending");
}
print_r($txupdate->errorInfo());

}
print_r($sql1->errorInfo());

}
print_r($sql12->errorInfo());


}else {
print_r($sql->errorInfo());
return false;
}
}


function createorders($serviceprovi,$case,$url,$reqcounts,$sellprice,$buyprice,$totalprice,$saleprice,$peritem,$display,$userbalance,$userid,$usergroup){
$orginalurl=$url;
global $dbh;
$sql=$dbh->prepare("select c.provider as providername,d.service from smme_admin_serviceprovider c,smme_admin_services_list d where c.id=d.provider and d.provider=? and d.service=?");
$sql->execute(array($serviceprovi,$case));
$detailpro=$sql->fetch();
$service=$detailpro['providername'];
switch($service){
case "Facebook":
switch ($case){
case "Followers":
$price=$totalprice;
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_followers($url);
break;
case "Page Likes":
$price=$totalprice;
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_fanpagelikes($url);
break;
case "Photo Likes":
$price=$totalprice;
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_photolikes($url);
break;
case "Group Join":
$price=$totalprice;
$obj=new facebook_without_api();	
$scounts=$obj->get_fb_groupmember($url);
break;	
default:
$price=$totalprice;
$scounts=0;
break;
}
break;


case "Twitter":
switch($case){
case "Follower":
$price=$totalprice;
$url=$url;
$Followgram=new twitter_without_api();
$scounts=$Followgram->get_twitter_followers($url);	
break;	
case "Retweet":
$price=$totalprice;
$url=$url;
$Followgram=new twitter_without_api();
$scounts=$Followgram->get_twitter_retweets($url);	
break;
case "Favorite":
$price=$totalprice;
$url=$url;
$Followgram=new twitter_without_api();
$scounts=$Followgram->get_twitter_favorites($url);	
break;	
default:
$price=$totalprice;
$scounts=0;	
break;
}
break;
case "Instagram":
switch($case){
case "Follower":	
$price=$totalprice;
$url=$url;
$Followgramnet = new instagram_without_api();
$scounts=$Followgramnet->get_instagram_followers($url);
break;	
case "Like":
$price=$totalprice;
$url=$url;
$Followgramnet = new instagram_without_api();
$scounts=$Followgramnet->get_instagram_likes($url);
break;
case "Comment":	
$price=$totalprice;
$url=$url;
$Followgramnet = new instagram_without_api();
$scounts = $Followgramnet->get_instagram_comments($url);
break;
default:
$price=$totalprice;
$scounts=0;
break;
}
break;
case "Vine":
switch($case){
case "Follower":
$price=$totalprice;
$obj=new vine_without_api();	
$scounts=$obj->get_vine_followers($url);
break;
case "Like":
$price=$totalprice;
$obj=new vine_without_api();	
echo $scounts=$obj->get_vine_likes($url);
break;
case "Comment":
$price=$totalprice;
$obj=new vine_without_api();	
$scounts=$obj->get_vine_comments($url);
break;
case "Revine":
$price=$totalprice;
$obj=new vine_without_api();	
$scounts=$obj->get_vine_revines($url);
break;
default:
$price=$totalprice;
$scounts=0;
break;	
}
break;
case "Soundcloud":
switch($case){
case "Plays":	
$price=$totalprice;
$url=$url;
$Followgramnet = new soundcloud_without_api();
$scounts=$Followgramnet->get_soundcloud_plays($url);
break;
case "Downloads":		
$price=$totalprice;
$url=$url;
$Followgramnet = new soundcloud_without_api();
$scounts=$Followgramnet->get_soundcloud_downloads($url);
break;
case "Followers":	
$price=$totalprice;
$url=$url;
$Followgramnet=new soundcloud_without_api();
$scounts=$Followgramnet->get_soundcloud_followers($url);
break;
default:
$price=$totalprice;
$scounts=0;
break;	
}
break;

case "Youtube":
switch($case){
case "View":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$url=preg_replace($patterns, $replacements,$clean);  
$price=$totalprice;
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_views($url);
break;
case "Like":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$url=preg_replace($patterns, $replacements,$clean);  
$price=$totalprice;
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_likes($url);
break;
case "Dislike":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$url=preg_replace($patterns, $replacements,$clean);  
$price=$totalprice;
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_dislikes($url);
break;
case "Comment":
$clean=str_replace("/","",$url);
$clean=str_replace(".","",$clean);
$clean=str_replace("?v=","",$clean);
$patterns = array();
$patterns[0] = '/https/';
$patterns[1] = '/http/';
$patterns[2] = '/:/';
$patterns[3]='/www/';
$patterns[4]='/youtubecomwatch/';
$replacements = array();
$replacements[0] = '';
$replacements[1] = '';
$replacements[2] = '';
$replacements[3] = '';
$replacements[4] = '';
$url=preg_replace($patterns, $replacements,$clean);  
$price=$totalprice;
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_comment($url);
break;
case "Subscriber":
$price=$totalprice;
$Followgram=new youtube_without_api();
$scounts=$Followgram->get_youtube_subscribers($url);
break;
default:
$price=$totalprice;
$scounts=0;
break;
}
break;
default:
$price=$totalprice;
$scounts=0;
break;
}
if($scounts==""){
$scounts=0;
}
$afterbalance=$userbalance-$price;
$return=$this->storeorder($case,$userid,$order_id,$display,$price,$saleprice,$userbalance,$afterbalance,$_SERVER['REMOTE_ADDR'],$service,date("Y-m-d"),$saleprice,$sellprice,$peritem,$reqcounts,$scounts,$orginalurl);	
return $return;	
}

function createorder($email,$scode,$key,$service,$type,$count,$data){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_serviceprovider where provider=?");
$sql->execute(array($service));	
if($sql->rowCount()==0){
return array("Code"=>"101","Message"=>"Service Not Found");	
}else{
$providerdetails=$sql->fetch();
$sql=$dbh->prepare("select * from smme_admin_services where display=? and site=? and status=?");
$sql->execute(array($type,$providerdetails['id'],"Active"));	
if($sql->rowCount()==0){
return array("Code"=>"102","Message"=>"Type Not Found");	
}else{
$servicedetails=$sql->fetch();	
$profile=$this->profiledetails($email);
$res=$this->getcustomerprice($servicedetails['id'],$count,$profile['smmeid'],$profile['groups']);
$balance=$this->checkbalance($profile['balance'],$res['totalprice']);	
if($balance==true){
$status=$this->createorders($res['site'],$res['ser'],$data,$count,$res['sellprice'],$res['buyprice'],$res['totalprice'],$res['saleprice'],$res['per_item'],$res['displayid'],$profile['balance'],$profile['smmeid'],$profile['groups']);
if(is_array($status) && $status[0]==true){
return array("Code"=>"100","Message"=>"Added","Order No"=>$status[1],"Url"=>$status[2],"Start Count"=>$status[3],"Current Count"=>$status[4],"Status"=>$status[5]);
}else{
return array("Code"=>"104","Message"=>"Unknown Error");
}
}else {
return array("Code"=>"103","Message"=>"Required Balance");	
}	
}
}
}

function getorderdetails($email,$scode,$key,$orderid){
global $dbh;	
$logincheck=$this->checkapidetails($email,$scode,$key);	
if($logincheck==1){
$profile=$this->profiledetails($email);
$sql=$dbh->prepare("select * from smme_users_order where id=? and smmeid=?");
$sql->execute(array($orderid,$profile['smmeid']));
if($sql->rowCount()==1){
$sql=$dbh->prepare("select smme_users_order.id,smme_users_order.price,smme_users_order.date,smme_users_order.ftime,smme_users_order.count,smme_users_order_urls.startcount,smme_users_order_urls.finishcount,smme_users_order_urls.url,smme_users_order_urls.refundreason,smme_users_order_status.status,smme_admin_services.display from smme_users_order,smme_users_order_status,smme_users_order_urls,smme_admin_services where smme_users_order.id=smme_users_order_urls.orderid and smme_users_order.status=smme_users_order_status.id and smme_users_order.servicetype=smme_admin_services.id and smme_users_order.id=? and smme_users_order.smmeid=?");	
$sql->execute(array($orderid,$profile['smmeid']));	
$res=$sql->fetch();
$returncode=array("Code"=>"106","Message"=>"Order Found","Order No"=>$res['id'],"Url"=>$res['url'],"Start Count"=>$res['startcount'],"Current Count"=>$res['finishcount'],"Status"=>$res['status']);	
}	
else {
$returncode=array("Code"=>"105","Message"=>"Order Not Found");	
}
}else {
$returncode=array("Code"=>"999","Message"=>"Auth Failed");	
}
return $returncode;
}
}
?>