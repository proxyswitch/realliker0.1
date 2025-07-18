<?php require_once("smmeconfig.php");
class profile{

function __construct(){
global $dbh;
$sql=$dbh->prepare("SELECT * FROM smme_users WHERE username=? or email=?");
$sql->execute(array($_SESSION['smmebhaveshsitelike'],$_SESSION['smmebhaveshsitelike']));
$login=$sql->fetch();
if($login['status']==1){
unset($_SESSION['smmebhaveshsitelike']);
header("location:index.php");
}
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
function sitecontent($page){
global $dbh;
$sql=$dbh->prepare("select * from smme_site_pages where pagename=?");
$sql->execute(array($page));
$res=$sql->fetch();
return $res['content'];
}
function profileupdate($name,$skype){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select * from smme_users_profile where skype=? and smmeid!=?");
$sql->execute(array($skype,$userid));
if($sql->rowCount()==0){
$sql=$dbh->prepare("update smme_users_profile set name=?,skype=? where smmeid=?");
$sql->execute(array($name,$skype,$userid));
return 1;
}else {
return 0;	
}
}
function secure_string($length) {
$str="";
$chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($chars);
for($i = 0;$i < $length;$i++) {
$str .= $chars[rand(0,$size-1)];
}
return $str;
}
function changepassword($currentpassword,$newpassword){
global $dbh;	
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select password,ency from smme_users where id=?");
$sql->execute(array($userid));
$old=$sql->fetch();
$oldpassword=$old['password'];
$securesalt=$old['ency'];
$site_salt="regsoldsmmexchange";
$salted_hash = hash('sha256',$currentpassword.$site_salt.$securesalt);
if($oldpassword==$salted_hash){ 
$p_salt =$this->secure_string(20); 
$site_salt="regsoldsmmexchange";
$password= hash('sha256',$newpassword.$site_salt.$p_salt);
$sql=$dbh->prepare("update smme_users set password=?,ency=? where id=?");
$sql->execute(array($password,$p_salt,$userid));
$config=$this->adminconfig();
$from=$config['fromemail'];
$to=$profile['email'];	
$subject="Password Changed - smmexchange";
$message="Hello ".$profile['name']."<br><br>
Recently you have changed password its updated successfully. if u not please contact support team.";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);
return 1;
}else {
return 0;
}
}
function pagination($count,$perpage,$currentpage,$searchterm){
$page=$currentpage;
$cur_page=$page; 
$page -=1;
$start=$page*$perpage;
$pagination=ceil($count/$perpage);
if($cur_page>7){
$start_page=$cur_page-3;
if($pagination>$cur_page+3)
$end_page=$cur_page+3;
if($cur_page<=$pagination && $cur_page>$pagination-6){
$start_page=$pagination-6;
$end_page=$pagination;
}
else{
$end_page=$cur_page+3;
}
}
else{
$start_page=1;
if($pagination>7)
$end_page=7;
else
$end_page=$pagination;
}
$msgs="";
$msgs.='<div class="orderpagination" ><ul class="list-inline">';
if($cur_page>1){
$msgs.='<li class="active" p="1" searchterms="'.stripslashes($searchterm).'"  >First</li>';
}
else{
$msgs.='<li class="inactive" searchterms="'.stripslashes($searchterm).'"  >First</li>';
}	  
if($cur_page>1){
$pre=$cur_page-1;
$msgs.='<li class="active" p="'.$pre.'" searchterms="'.stripslashes($searchterm).'"   >Previous</li>';
}
else{
$msgs.='<li class="inactive" searchterms="'.stripslashes($searchterm).'" >Previous</li>';
}
for($i=$start_page; $i<=$end_page; $i++){
if($cur_page==$i)
{
$msgs.='<li class="inactive" p='.$i.' id="current"  searchterms="'.stripslashes($searchterm).'"  >'.$i.'</li>';
}
else{
$msgs.='<li class="active" p="'.$i.'" searchterms="'.stripslashes($searchterm).'"  >'.$i.'</li>';
}
}
if($cur_page<$pagination)
{
$next=$cur_page+1;
$msgs.='<li class="active" p="'.$next.'"  searchterms="'.stripslashes($searchterm).'" >Next</li>';  
}
else
{
$msgs.='<li class="inactive" >Next</li>';  
}
if($cur_page<$pagination){
$msgs.='<li class="active" p="'.$pagination.'" searchterms="'.stripslashes($searchterm).'"  >Last</li>';
}
else
{
$msgs.='<li class="inactive" searchterms="'.stripslashes($searchterm).'" >Last</li>';
}
$msgs.="</ul>";
return $msgs;	
}
function adminconfig(){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_config");
$sql->execute();	
return $sql->fetch();	
}
function userreview($case){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
switch($case){
case "cdate":
return date("d-m-Y h:m:s a",strtotime($profile['date']));
break;
case "accverified":
if($profile['verified']==1){
return "Yes";	
}else {
return "No";	
}
break;
case "accdisclimer":
if($profile['disclaimer']==1){
return "Yes";	
}else {
return "No";	
}
break;
case "balance":
return $profile['balance'];
break;
case "yesterdayorders":
$sql=$dbh->prepare("select * from smme_users_order where smmeid=? and searchdate=?");
$sql->execute(array($profile['smmeid'],date('Y-m-d',strtotime("-1 day"))));
return $sql->rowCount();
break;
case "todayorders":
$sql=$dbh->prepare("select * from smme_users_order where smmeid=? and searchdate=?");
$sql->execute(array($profile['smmeid'],date('Y-m-d')));
return $sql->rowCount();
break;
case "lastlogged":
$sql=$dbh->prepare("select * from smme_users_login_histroy where smmeid=? order by id desc limit 1");
$sql->execute(array($profile['smmeid']));
if($sql->rowCount()==0){
return "New User";
}else{
$res=$sql->fetch();
return "@".date("d-m-Y h:m:i a",strtotime($res['logintime']));
}
break;
}	
}
function accpetdisclaimer(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("update smme_users set disclaimer=? where id=?");
$sql->execute(array(1,$userid));
}

function checkreplyalert(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select * from smme_users_tickets where usernoti=? and smmeid=?");
$sql->execute(array(1,$userid));
return $sql->rowCount();
}




}
?>