<?php require_once("userprofile.class.php");
class notification extends profile{
function getnotificationalert(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$sql=$dbh->prepare("select * from smme_users_notification where status=?");
$sql->execute(array(0));
$counts=$sql->rowCount();
return array($profile['notification'],$counts);
}	
function getnotificationlist(){
global $dbh;
$sql=$dbh->prepare("select * from smme_users_notification where status=?");
$sql->execute(array(0));
if($sql->rowCount()>0){	
return $sql->fetchAll();
}else{
	return 1;
}	
}	
function notificationalertoff(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);	
$uid=$profile['smmeid'];
$sql=$dbh->prepare("update smme_users_profile set notification=? where smmeid=?");
$sql->execute(array(0,$uid));
print_r($sql->errorInfo());	
}
}
?>