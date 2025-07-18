<?php require_once("smmeconfig.php");
class profile{
function profiledetails($smid){
global $dbh;
$sql=$dbh->prepare("SELECT id FROM smme_users WHERE id=?");
$sql->execute(array($smid));
$login=$sql->fetch();
$sql=$dbh->prepare("SELECT smme_users.username,smme_users.email,smme_users.date,smme_users.verified,smme_users.disclaimer,smme_users_wallet.balance,d.* FROM smme_users,smme_users_wallet,smme_users_profile d WHERE smme_users.id=d.smmeid and d.smmeid=smme_users_wallet.smmeid and smme_users.id=?");
$sql->execute(array($login['id']));
$profile=$sql->fetch();
return $profile;
}

}
?>