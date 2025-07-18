<?php require_once("common.class.php");

class users extends common{
	
function getrocords($username,$page,$perpage){
$searchby="";	
if($username!=""){
$searchby=' and (smme_users.username="'.$username.'" OR smme_users.email="'.$username.'")';	
}	
	
	
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;
$sql=$dbh->prepare("select smme_users.id,smme_users.username,smme_users.email,smme_users.ipaddress,smme_users.date,smme_users.reason,smme_users.verified,smme_users.status,smme_users_profile.skype,smme_users_profile.name,smme_users_profile.groups,smme_users_profile.smmeid,smme_users_profile.2co,smme_users_profile.2choauto,smme_users_profile.payauto,smme_users_wallet.balance,smme_users_group.group_name from smme_users,smme_users_profile,smme_users_wallet,smme_users_group where smme_users.id=smme_users_profile.smmeid and smme_users.id=smme_users_wallet.smmeid and smme_users_profile.groups=smme_users_group.id ".$searchby." order by smme_users.id limit $start, $perpage");
$sql->execute();
$rowcount=$sql->rowcount();
$pag=$dbh->prepare("select smme_users.id,smme_users.username,smme_users.email,smme_users.ipaddress,smme_users.date,smme_users.reason,smme_users.verified,smme_users.status,smme_users_profile.skype,smme_users_profile.name,smme_users_profile.groups,smme_users_profile.smmeid,smme_users_profile.2co,smme_users_profile.2choauto,smme_users_profile.payauto,smme_users_wallet.balance,smme_users_group.group_name from smme_users,smme_users_profile,smme_users_wallet,smme_users_group where smme_users.id=smme_users_profile.smmeid and smme_users.id=smme_users_wallet.smmeid and smme_users_profile.groups=smme_users_group.id ".$searchby."");
$pag->execute();
$count=$pag->rowCount();
if($count>0){
$res=$sql->fetchAll();
$pagin=$this->pagination($count,$perpage,$cur_page,'',"manageusers");
return array($res,$pagin);
}else {
return "No Record Found.";
}
}

function changestatus($ids,$status){
global $dbh;	
$ids=explode(",",$ids);
foreach($ids as $id){
$sql1=$dbh->prepare("update smme_users set status=? where id=?");
$sql1->execute(array($status,$id));
}
}

function multiuserdelete($ids){
global $dbh;	
$ids=explode(",",$ids);
foreach($ids as $id){
$sql=$dbh->prepare("delete from smme_users where id=?");
$sql->execute(array($id));
$sql=$dbh->prepare("delete from smme_users_profile where smmeid=?");
$sql->execute(array($id));
}
return "Deleted Successfully";
}

function deleteuser($email){
global $dbh;
$delete=$this->profiledetails($email);
$sql=$dbh->prepare("delete from smme_users_profile where smmeid=?");
$sql->execute(array($delete['smmeid']));
$sql=$dbh->prepare("delete from smme_users_order where smmeid=?");
$sql->execute(array($delete['smmeid']));
$sql=$dbh->prepare("delete from smme_users_tickets where smmeid=?");
$sql->execute(array($delete['smmeid']));
$sql=$dbh->prepare("delete from smme_users_transaction where smmeid=?");
$sql->execute(array($delete['smmeid']));
$sql=$dbh->prepare("delete from smme_users where email=?");
$sql->execute(array($email));
echo "deleted successfully";
}

function addbalance($email,$amt,$operation,$reason){
global $dbh;
$profile=$this->profiledetails($email);
if($operation=="add"){
$newbalance=$profile['balance']+(float)$amt;
$op="(+) ";
$txop="+";
}else{
$newbalance=$profile['balance']-(float)$amt;
$op="(-) ";
$txop="-";
}
$sql=$dbh->prepare("insert into  smme_admin_transaction(`reason`,`smmeid`,`amount`,`date`,`opfrom`,`ipaddress`,`operation`)values(?,?,?,?,?,?,?)");
$sql->execute(array($reason,$profile['smmeid'],(float)$amt,date("y-m-d h:i:s a"),$op.'admin',$_SERVER['REMOTE_ADDR'],$txop));
$reftxid=$dbh->lastInsertId();
$sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`orderid`,`admintxid`,`usernoti`)values(?,?,?,?,?,?,?,?,?)");
$sql->execute(array($profile['smmeid'],(float)$profile['balance'],(float)$amt,$newbalance,$txop,$_SERVER['REMOTE_ADDR'],0,$reftxid,1));
$refusertxid=$dbh->lastInsertId();
$sql=$dbh->prepare("update smme_admin_transaction set txid=? where id=? and smmeid=?");
$sql->execute(array("usertx:".$refusertxid,$reftxid,$profile['smmeid']));	
$sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
$sql->execute(array($newbalance,$profile['smmeid']));	
return "Operation Perfromed Successfully.";
}

function changepassword($newpassword,$id){
global $dbh;	
$p_salt =$this->rand_string(20); 
$site_salt="regsoldsmmexchange";
$password= hash('sha256',$newpassword.$site_salt.$p_salt);
$sql=$dbh->prepare("update smme_users set password=?,ency=? where id=?");
$sql->execute(array($password,$p_salt,$id));
return "Password has been updated";
}


function profileupdate($uid,$username,$email,$name,$skype,$groupid,$status,$pchekout,$pchekoutauto,$payauto){
global $dbh;	
$userid=$uid;
$sql=$dbh->prepare("select * from smme_users where username=? and id!=?");
$sql->execute(array($username,$uid));
$rowcount=$sql->rowCount();
if($rowcount==0){
$sql=$dbh->prepare("select * from smme_users where email=? and id!=?");
$sql->execute(array($email,$uid));
$rowcount=$sql->rowCount();
if($rowcount==0){	
$sql=$dbh->prepare("update smme_users_profile set name=?,skype=?,groups=?,2co=?,2choauto=?,payauto=? where smmeid=?");
$sql->execute(array($name,$skype,$groupid,$pchekout,$pchekoutauto,$payauto,$userid));
$sql=$dbh->prepare("update smme_users set username=?,email=?,status=?,reason=? where id=?");
$sql->execute(array($username,$email,$status,"",$userid));
}else {
return 2;	
}}else {
return 1;	
}
}


function createuser($email,$password,$name,$skype,$group,$activate,$pcheckout,$pchekoutauto,$payauto){
global $dbh;
$sql=$dbh->prepare("SELECT COUNT(*) FROM `smme_users` WHERE `email`=?");
$sql->execute(array($email));
if($sql->fetchColumn()!=0){
return "2";
}else{
$p_salt =$this->rand_string(20); 
$site_salt="mysecureregsmmebhadevsecure";
$password= hash('sha256', $password.$site_salt.$p_salt);
$sql=$dbh->prepare("INSERT INTO `smme_users` (`username`,`email`, `password`,`ency`,`ipaddress`,`disclaimer`,`status`) VALUES (?,?,?,?,?,?,?);");
$sql->execute(array("123".$email,$email,$password,$p_salt,$_SERVER['REMOTE_ADDR'],0,$activate));
$insertid=$dbh->lastInsertId();
$sql=$dbh->prepare("INSERT INTO `smme_users_profile` (`smmeid`, `name`,`skype`,`groups`,`2co`,`2choauto`,`payauto`) VALUES (?,?,?,?,?,?,?);");
$sql->execute(array($insertid,$name,$skype,$group,$pcheckout,$pchekoutauto,$payauto));
$sql=$dbh->prepare("INSERT INTO `smme_users_wallet` (`smmeid`, `balance`) VALUES (?,?);");
$sql->execute(array($insertid,0));
return  "Successfully Registered.";
}

}	

function readminconfig(){
global $dbh;	
$sql=$dbh->prepare("select * from smme_admin_config where id=?");
$sql->execute(array(1));
return $sql->fetch();
}


function resendemailverification($ids){
global $dbh;	
$ids=explode(",",$ids);
foreach($ids as $id){
$sql=$dbh->prepare("select a.*,d.* from smme_users a,smme_users_profile d where a.id=d.smmeid and a.id=?");
$sql->execute(array($id));
$profile=$sql->fetch();
$to=$profile['email'];
$uid=$profile['smmeid'];
$name=$profile['name'];
$config=$this->readminconfig();	
$from=$config['fromemail'];
$token=bin2hex(rand(34,16).date("dmy"));
$sql=$dbh->prepare("update smme_users_email_verification set token=?,ipaddress=?,status=? where smmeid=?");
$sql->execute(array($token,$_SERVER['REMOTE_ADDR'],0,$uid));
$sql=$dbh->prepare("update smme_users set status=? where smmeid=?");
$sql->execute(array(0,$uid));	
$emaillink="<a href='http://www.smmexchange.com/emailactivation?email=".$to."&emailtoken=".$token."'>Click here to verify your email.</a>";
$subject="Activation Link - smmexchange";
$message="Hello ".$name."<br><br>
Thank you for registering with us.<br><br>
Please visit the link below to activate your account:  Link Here<br><br>
".$emaillink."";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ' .$from. "\r\n";
mail($to,$subject, $message, $headers);	
}

}



}
?>