<?php  require_once("makeorder.class.php");

class addorderforauto extends createorder{

function updateautoorderstatus($autoorderid,$status){
global $dbh;
$sql=$dbh->prepare("update smme_users_auto_orders set status=? where id=?");
$sql->execute(array($status,$autoorderid));
}


function addorder($smmeid,$serviceid,$url,$count,$autoorderid){
$res=$this->order($serviceid,$url,$count,"",$smmeid,$autoorderid);
if($res==3){
$this->updateautoorderstatus($autoorderid,3);
}
}



function getlastpost($username){
$insta_source =@file_get_contents('https://www.instagram.com/web/search/topsearch/?query=' . $username);
$data = json_decode($insta_source, true);
$m1 = $data["users"][0]["user"]["pk"];
$latest_array =@file_get_contents('https://www.instagram.com/graphql/query/?query_id=17880160963012870&id='.$m1.'&first=5'); //replace with user
$results_array = json_decode($latest_array , TRUE);
$post_id=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['shortcode'];
$lastupdate=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['taken_at_timestamp'];
return array('http://instagram.com/p/'.$post_id,$lastupdate);
}

function checkisvideo($username){
$insta_source =@file_get_contents('https://www.instagram.com/web/search/topsearch/?query=' . $username);
$data = json_decode($insta_source, true);
$m1 = $data["users"][0]["user"]["pk"];
$latest_array =@file_get_contents('https://www.instagram.com/graphql/query/?query_id=17880160963012870&id='.$m1.'&first=5'); //replace with user
$results_array = json_decode($latest_array , TRUE);
$post_id=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['shortcode'];
$lastupdate=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['taken_at_timestamp'];
$isvideo=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['is_video'];
if($isvideo=="true"){
return array('http://instagram.com/p/'.$post_id,$lastupdate);
}else{
return 0;
}
}


function checklastpostnew($username){
$insta_source =@file_get_contents('https://www.instagram.com/web/search/topsearch/?query=' . $username);
$data = json_decode($insta_source, true);
$m1 = $data["users"][0]["user"]["pk"];
$latest_array =@file_get_contents('https://www.instagram.com/graphql/query/?query_id=17880160963012870&id='.$m1.'&first=5'); //replace with user
$results_array = json_decode($latest_array , TRUE);
$isprivate=$data["users"][0]["user"]["is_private"];
$post_id=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['shortcode'];
$lastupdate=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['taken_at_timestamp'];
$isvideo=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['is_video'];
$lastpost="https://www.instagram.com/p/".$post_id;	
return array($lastpost,$lastupdate,$isvideo,$isprivate);	
}


function getnextpost($autoorderid,$smmeid,$serviceid,$username,$lastchecked,$count){
global $dbh;
$res=$this->checklastpostnew($username);	
if($res[3]!=1){
if($serviceid==98){
if($res[2]!=1){
$cur=(int)$res[1];
$last=(int)$lastchecked;
if($cur>$last){
$sql=$dbh->prepare("update smme_users_auto_orders set status=?,lastchecked=? where id=?");
$sql->execute(array(2,time(),$autoorderid));
$sql=$dbh->prepare("select * from smme_users_order_urls where url=?");
$sql->execute(array($res[0]));
if($sql->rowCount()==0){
$this->addorder($smmeid,$serviceid,$res[0],$count,$autoorderid);
}
}
}
}else{
$cur=(int)$res[1];
$last=(int)$lastchecked;
if($cur>$last){
$sql=$dbh->prepare("update smme_users_auto_orders set status=?,lastchecked=? where id=?");
$sql->execute(array(2,time(),$autoorderid));
$sql=$dbh->prepare("select * from smme_users_order_urls where url=?");
$sql->execute(array($res[0]));
if($sql->rowCount()==0){
$this->addorder($smmeid,$serviceid,$res[0],$count,$autoorderid);
}
}
}
$sql=$dbh->prepare("update smme_users_auto_orders set userprivatestatus=? where iusername=?");
$sql->execute(array(0,$username));
}else{
$sql=$dbh->prepare("update smme_users_auto_orders set status=?,userprivatestatus=? where iusername=?");
$sql->execute(array(7,1,$username));	
}
}

function getnoautoadded($autoorderid){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_order  where autoorderid=?");
$sql->execute(array($autoorderid));
return $sql->rowCount();
}


function getautomaticorders(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_auto_orders where status!=? and status!=? and status!=? and status!=?");
$sql->execute(array(4,6,7,8));
if($sql->rowCount()>0){
$res=$sql->fetchAll();
foreach($res as $records){
$alreadyaddedautoorders=$this->getnoautoadded($records['id']);
if($alreadyaddedautoorders>=$records['noofpost']){
$this->updateautoorderstatus($records['id'],4);
}else{
$this->getnextpost($records['id'],$records['smmeid'],$records['serviceid'],$records['iusername'],$records['lastchecked'],$records['count']);
}
}
}
}
}
?>