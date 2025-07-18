<?php require_once("userprofile.class.php");
class wallet extends profile{

function checkautopaymentpaypal(){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
return $profile['payauto'];
}


function addbalance($item_name,$item_transaction,$item_price,$item_currency,$payer_email,$receiver_email,$date){
global $dbh;
$profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
$sql=$dbh->prepare("select * from smme_admin_transaction where txid=?");
$sql->execute(array($item_transaction));
if($sql->rowCount()==0){
$sql=$dbh->prepare("INSERT INTO smme_admin_transaction(`smmeid`,`txid`,`reason`,`amount`,`payer_email`,`receiver_email`,`date`,`opfrom`,`ipaddress`,`adminnotification`,`operation`)
VALUES(?,?,?,?,?,?,?,'paypal','".$_SERVER['REMOTE_ADDR']."',?,?)");
if($sql->execute(array($profile['smmeid'],$item_transaction,$item_name,$item_price,$payer_email,$receiver_email,$date,1,"+"))){
$admintxid=$dbh->lastInsertId();
$nowbal=$profile['balance']+$item_price;
$sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`admintxid`)values(?,?,?,?,?,?,?)");
if($sql->execute(array($profile['smmeid'],$profile['balance'],$item_price,$nowbal,"+",$_SERVER['REMOTE_ADDR'],$admintxid))){
$sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
$sql->execute(array($nowbal,$profile['smmeid']));
}
}
return "Payment has been added to your acccount";
}else {
return "We can't process this request. Please write a ticcket";
}
}	

}
?>