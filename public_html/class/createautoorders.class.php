<?php require_once("userprofile.class.php");
require_once("insta/InstagramFunc.php");
class createautoorder extends profile{

function getlastpost($username){
$login_cookie = Logincookie('kenanorge25756ewl');
$Info = Userid($username, $login_cookie);
if($Info[0]!=""){
	$Info = Userid($username, $login_cookie);
if(count($Info[0])>0){
/*$insta_source =@file_get_contents('http://api.instagram.com/oembed?url=' . $username);
if($insta_source!=""){
	$data = json_decode($insta_source, true);
if(count($data)>0){
$m1 = $data['author_id'];
$uname = $data['author_name'];
*/
$latest_array =@file_get_contents('https://www.instagram.com/graphql/query/?query_id=17880160963012870&id='.($Info[0]).'&first=5'); //replace with user
$results_array = json_decode($latest_array , TRUE);
$post_id=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['shortcode'];
$lastupdate=$results_array['data']['user']['edge_owner_to_timeline_media']['edges'][0]['node']['taken_at_timestamp'];
//echo $uname;
//echo $Info[0];
return array('http://instagram.com/p/'.$post_id,$lastupdate);
}else{
return 5;
}
}else{
return 6;
}
}


function createautomaticorder($service,$username,$count,$noofpost){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_auto_orders where serviceid=? and iusername=? and status==? and status==? and status==? and status==? and status==?");
$sql->execute(array($service,$username,1,2,3,5,6));
//print_r($sql->fetchAll());
//echo $sql->rowCount();
if($sql->rowCount()==0){
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$uid=$profile['smmeid'];
$lastpost=$this->getlastpost($username);
if(is_array($lastpost)){
$status=1;
}else{
$status=$lastpost;
} 
$sql=$dbh->prepare("insert into smme_users_auto_orders (`smmeid`,`serviceid`,`iusername`,`count`,`noofpost`,`status`,`lastchecked`)values(?,?,?,?,?,?,?)");
$sql->execute(array($uid,$service,$username,$count,$noofpost,$status,time()));
$autoorderid=$dbh->lastInsertId();
return 1;
}else{
return 2;
}
}	
}
?>