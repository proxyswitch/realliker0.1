<?php require_once("userprofile.class.php");
require_once("getservicecountapi.php");
class createorder extends profile{
	
// final process for order add to site	

function storeorder($case,$id,$orderid,$type,$price,$orginalprice,$beforebalance,$afterbalance,$ipaddress,$service,$date,$saleprice,$sellprice,$peritem,$reqcounts,$startcount,$url,$extdata,$autoorderid){
global $dbh;
$sql=$dbh->prepare("select id from smme_admin_serviceprovider where provider=?");
$sql->execute(array($service));
$getservice=$sql->fetch();
$service=$getservice['id'];

$checkurl=$dbh->prepare("select a.*,b.* from smme_users_order a,smme_users_order_urls b where a.smmeid=? and a.servicetype=? and a.autoorderid=? and b.url=?");
$checkurl->execute(array($id,$type,$autoorderid,$url));
if($checkurl->rowCount()==0){
$sql=$dbh->prepare("INSERT INTO `smme_users_order` (smmeid,servicetype,price,oprice,ipaddress,service,byprice,sprice,scount,count,status,searchdate,autoorderid) VALUES (?,?, ?, ?, ?, ?, ?,?, ?, ?, ?,?,?);");
if($sql->execute(array($id,$type,$price,$orginalprice,"auto",$service,$saleprice,$sellprice,$peritem,$reqcounts,1,date("Y-m-d"),$autoorderid))){
$neworderid=$dbh->lastInsertId();
$sql12=$dbh->prepare("insert into smme_users_order_urls(`orderid`,`smmeid`,`url`,`startcount`,`finishcount`,`extdata`)values(?,?,?,?,?,?)");
if($sql12->execute(array($neworderid,$id,$url,$startcount,$startcount,$extdata))){
$sql1=$dbh->prepare("insert into smme_users_transactions (`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`)values(?,?,?,?,?,?,?)");
if($sql1->execute(array($id,$beforebalance,$price,$afterbalance,'-',"auto",$neworderid))){
$txid=$dbh->lastInsertId();
$txupdate=$dbh->prepare("UPDATE smme_users_order set txno=? where id=?");
if($txupdate->execute(array($txid,$neworderid))){
$bupdate=$dbh->prepare("UPDATE smme_users_wallet set balance=? where smmeid=?");
$bupdate->execute(array($afterbalance,$id));
return true;
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
}	
	
	
	
	
	
	
	
// order processing from api


function createorders($serviceprovi,$case,$url,$reqcounts,$sellprice,$buyprice,$totalprice,$saleprice,$peritem,$display,$userbalance,$userid,$usergroup,$extdata,$autoorderid){
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
case "Mention":	
$price=$totalprice;
$url=$url;
$Followgramnet = new instagram_without_api();
$scounts = $Followgramnet->get_instagram_mention($url);
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
$return=$this->storeorder($case,$userid,$order_id,$display,$price,$saleprice,$userbalance,$afterbalance,"auto",$service,date("Y-m-d"),$saleprice,$sellprice,$peritem,$reqcounts,$scounts,$orginalurl,$extdata,$autoorderid);	
return $return;	
}
	
	
	
	
// compare total price and current user balance

function checkbalance($currentbalance,$totalprice){
if($currentbalance=='0' || $currentbalance<0 || $currentbalance<$totalprice){
return false;
}else {
return true;
}
}	

// calculate total price for service	
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

// get customer price for service from specif user or group	
	
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

// create order from post variables


function order($postservice,$posturl,$postcount,$extdata,$smmeid,$autoorderid){
$profile=$this->profiledetails($smmeid);
$res=$this->getcustomerprice($postservice,$postcount,$profile['smmeid'],$profile['groups']);
$balance=$this->checkbalance($profile['balance'],$res['totalprice']);
if($balance==true){
$status=$this->createorders($res['site'],$res['ser'],$posturl,$postcount,$res['sellprice'],$res['buyprice'],$res['totalprice'],$res['saleprice'],$res['per_item'],$res['displayid'],$profile['balance'],$profile['smmeid'],$profile['groups'],$extdata,$autoorderid);
if($status==true){
return 1;
}else{
return 2;
}
}else {
return 3;
}
}	
	
}
?>