<?php require_once("connection.php");
class common{
function profiledetails($email){
global $dbh;
$sql=$dbh->prepare("SELECT * FROM smme_users WHERE username=? or email=?");
$sql->execute(array($email,$email));
$login=$sql->fetch();
$sql=$dbh->prepare("SELECT smme_users.email,smme_users_wallet.balance,d.* FROM smme_users,smme_users_wallet,smme_users_profile d WHERE smme_users.id=d.smmeid and smme_users_wallet.smmeid=d.smmeid and smme_users.id=?");
$sql->execute(array($login['id']));
$profile=$sql->fetch();
return $profile;
}	
function rand_string($length) {
$str="";
$chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($chars);
for($i = 0;$i < $length;$i++) {
$str .= $chars[rand(0,$size-1)];
}
return $str;
}
function pagination($count,$perpage,$currentpage,$searchterm,$class){
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
$msgs.='<div class="'.$class.' orderpagination" ><ul class="list-inline pagination">';
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
$msgs.="</ul></div>";	
return $msgs;	
}
function status(){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_status");
$sql->execute();
return $sql->fetchAll();
}
function orderstatus(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_order_status");
$sql->execute();
return $sql->fetchAll();
}

function autoorderstatus(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_auto_order_status");
$sql->execute();
return $sql->fetchAll();
}
function usergroup(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_group");
$sql->execute();
return $sql->fetchAll();
}
function allusers(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users");
$sql->execute();
return $sql->fetchAll();
}
function getservicedisplay(){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_services");
$sql->execute();
$res=$sql->fetchAll();
return $res;
}
function serviceproviderlist(){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_serviceprovider");
$sql->execute();
$res=$sql->fetchAll();
return $res;	
}

function activeapikeys(){
global $dbh;
$sql=$dbh->prepare("select * from smme_admin_api");
$sql->execute();
$res=$sql->fetchAll();
return $res;	
}

function checkreplyalert(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_tickets where noti=?");
$sql->execute(array(1));
return $sql->rowCount();
}


}
?>