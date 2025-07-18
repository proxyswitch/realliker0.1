<?php require_once("common.class.php");

class tickets extends common{
	
function getrocords($searchterms,$page,$perpage){
$pagsearch=$searchterms;	
$searchquery=explode(",",$searchterms);	
$query="";
if(isset($searchquery[0]) && $searchquery[0]!=""){
$query.='and (d.smmeid="'.$searchquery[0].'" OR d.smmeid="'.$searchquery[0].'")';
}
if(isset($searchquery[1]) && $searchquery[1]!=""){
$query.=' and d.status="'.$searchquery[1].'"';
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$sql=$dbh->prepare("select smme_users.email,smme_users.username,smme_users_profile.name,d.* from smme_users,smme_users_profile,smme_users_tickets d where smme_users.id=smme_users_profile.smmeid and smme_users.id=d.smmeid ".$query." order by d.status=? limit $start, $perpage");
$sql->execute(array(1));
$rowcount=$sql->rowcount();
$pag=$dbh->prepare("select smme_users.email,smme_users.username,smme_users_profile.name,d.* from smme_users,smme_users_profile,smme_users_tickets d where smme_users.id=smme_users_profile.smmeid and smme_users.id=d.smmeid ".$query."");
$pag->execute();
$count=$pag->rowCount();
if($count>0){
$res=$sql->fetchAll();
$pagin=$this->pagination($count,$perpage,$cur_page,'',"");
return array($res,$pagin);
}else {
return "No Record Found.";
}
}

function viewticket($id){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_tickets where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
$sql=$dbh->prepare("select * from smme_users_tickets_conversation where tid=?");
$sql->execute(array($id));
$res1=$sql->fetchAll();
return array($res,$res1);
}

function updateticket($id,$content,$status){
global $dbh;
if($status==1){
$noti=0;
}else{
$noti=1;
}
$sql=$dbh->prepare("update smme_users_tickets set noti=?,usernoti=?,status=? where id=?");
$sql->execute(array(0,$noti,$status,$id));
$sql=$dbh->prepare("insert into smme_users_tickets_conversation (`tid`,`from`,`content`) values (?,?,?)");
$sql->execute(array($id,1,$content));
$sql=$dbh->prepare("select * smme_users_tickets where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
$sql=$dbh->prepare("select c.name,d.email from smme_users_profile c,smme_users d where d.id=c.smmeid and d.id=?");
$sql->execute(array($res['smmeid']));
$profile=$sql->fetch();
$from="support@smmexchange.com";
$to=$profile['email'];	
$subject=$subject." Ticket No - ".$id."- smmexchange";
$message="Hello ".$profile['name']."<br><br>
Admin Message: ".$content."";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);
}

function deletetickets($ids){
global $dbh;
$id=explode(",",$ids);
foreach($id as $did){
$sql=$dbh->prepare("delete from smme_users_tickets where id=?");
$sql->execute(array($did));
$sql=$dbh->prepare("delete from smme_users_tickets_conversation where tid=?");
$sql->execute(array($did));
}
}



}
?>