<?php require_once("userprofile.class.php");
class tickets extends profile{
function gettickets($page,$perpage){
$search="";
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$uid=$profile['smmeid'];
$sql=$dbh->prepare("select * from smme_users_tickets where smmeid=? order by id desc limit $start,$perpage");
$sql->execute(array($uid));
if($sql->rowCount()>0){
$res=$sql->fetchAll();	
$sql=$dbh->prepare("select * from smme_users_tickets where smmeid=?");	
$sql->execute(array($uid));	
$totalrecords=$sql->rowCount();
$pagin=$this->pagination($totalrecords,$perpage,$cur_page,$search);
return array($res, $pagin);
}else {
return "No record found";
}
}
function viewticket($ticketid){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select smme_users_tickets.id,smme_users_tickets.subject,smme_users_tickets.cdate,smme_users_tickets.status,d.* from smme_users_tickets,smme_users_tickets_conversation d where smme_users_tickets.id=d.tid  and smme_users_tickets.smmeid=? and d.tid=? order by d.id asc");
$sql->execute(array($userid,(int)$ticketid));
$res=$sql->fetchAll();
return $res;	
}
function updateticket($ticketno,$replybox){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("select * from smme_users_tickets where smmeid=? and id=? and status=?");
$sql->execute(array($userid,$ticketno,0));
if($sql->rowCount()==1){
$predetails=$sql->fetch();	
$sql=$dbh->prepare("update smme_users_tickets set noti=?,usernoti=? where smmeid=? and id=?");
$sql->execute(array(1,0,$userid,$ticketno));
$sql=$dbh->prepare("insert into smme_users_tickets_conversation (`tid`,`from`,`content`)values(?,?,?)");
$sql->execute(array($ticketno,0,$replybox));	

$adminsupport=$this->adminconfig();
$from=$adminsupport['fromemail'];
$to=$profile['email'];	
$subject=$predetails['subject']." Ticket No - ".$ticketno."- smmexchange";
$message="Hello ".$profile['name']."<br><br>
We have received your query we will check and get back to u soon.<br><br>
Query Updated At: ".date("d-m-y h:i:s")."<br><br>
Query Subject   : ".$predetails['subject']."<br><br>
your Query      : ".$replybox."";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);
return 1;	
}else {
return 0;	
}
}
function createticket($subject,$content){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['smmeid'];
$sql=$dbh->prepare("insert into smme_users_tickets (`smmeid`,`subject`,`status`,`noti`)values(?,?,?,?)");
$sql->execute(array($userid,$subject,0,1));
$ticketid=$dbh->lastInsertId();
$sql=$dbh->prepare("insert into smme_users_tickets_conversation (`tid`,`from`,`content`)values(?,?,?)");
$sql->execute(array($ticketid,0,$content));
$adminsupport=$this->adminconfig();
$from=$adminsupport['fromemail'];
$to=$profile['email'];	
$subject=$subject." Ticket No - ".$ticketid."- smmexchange";
$message="Hello ".$profile['name']."<br><br>
We have received your query we will check and get back to u soon.<br><br>
Query Created At: ".date("d-m-y h:i:s")."<br><br>
Query Subject   : ".$subject."<br><br>
your Query      : ".$content."";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);
return 1;	
}
}