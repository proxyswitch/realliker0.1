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
$ip = $_SERVER['REMOTE_ADDR'];
if($sql->rowCount()==0){
$sql=$dbh->prepare("INSERT INTO smme_admin_transaction(`smmeid`,`txid`,`reason`,`amount`,`payer_email`,`receiver_email`,`date`,`opfrom`,`ipaddress`,`adminnotification`,`operation`)
VALUES(?,?,?,?,?,?,?,?,?,?)");
if($sql->execute(array($profile['smmeid'],$item_transaction,$item_name,$item_price,$payer_email,$receiver_email,$date,'paypal',$ip,1,"+"))){
$admintxid=$dbh->lastInsertId();
$nowbal=$profile['balance']+$item_price;
$sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`admintxid`)values(?,?,?,?,?,?,?)");
    if($sql->execute(array($profile['smmeid'],$profile['balance'],$item_price,$nowbal,"+",$ip,$admintxid))){
$sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
$sql->execute(array($nowbal,$profile['smmeid']));
}
}
return "Payment has been added to your acccount";
}else {
return "We can't process this request. Please write a ticcket";
}
}

function addbalancepayeer($transaction,$amount){
    global $dbh;
    $profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
    $sql=$dbh->prepare("select * from smme_admin_transaction where txid=?");
    $sql->execute(array($transaction));

    $ip = $_SERVER['REMOTE_ADDR'];
    if($sql->rowCount()==0){
        $sql=$dbh->prepare("INSERT INTO smme_admin_transaction(`smmeid`,`txid`,`reason`,`amount`,`opfrom`,`ipaddress`,`adminnotification`,`operation`) VALUES(?,?,?,?,?,?,?,?)");
        if($sql->execute(array($profile['smmeid'],$transaction,'Payeer Deposit',$amount,'payeer',$ip,1,"+"))){
            $admintxid=$dbh->lastInsertId();
            $nowbal=$profile['balance']+$amount;
            $sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`admintxid`)values(?,?,?,?,?,?,?)");
            if($sql->execute(array($profile['smmeid'],$profile['balance'],$amount,$nowbal,"+",$ip,$admintxid))){

    if($sql->rowCount()==0){
        $sql=$dbh->prepare("INSERT INTO smme_admin_transaction(`smmeid`,`txid`,`reason`,`amount`,`opfrom`,`ipaddress`,`adminnotification`,`operation`) VALUES(?,?,?,?,?,'".$_SERVER['REMOTE_ADDR']."',?,?)");
        if($sql->execute(array($profile['smmeid'],$transaction,'Payeer Deposit',$amount,'payeer',1,"+"))){
            $admintxid=$dbh->lastInsertId();
            $nowbal=$profile['balance']+$amount;
            $sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`admintxid`)values(?,?,?,?,?,?,?)");
            if($sql->execute(array($profile['smmeid'],$profile['balance'],$amount,$nowbal,"+",$_SERVER['REMOTE_ADDR'],$admintxid))){
                $sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
                $sql->execute(array($nowbal,$profile['smmeid']));
            }
        }
        return "Payment has been added to your account";
    }else {
        return "We can't process this request. Please write a ticket";
    }
}

function addbalancepaytm($transaction,$amount){
    global $dbh;
    $profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
    $sql=$dbh->prepare("select * from smme_admin_transaction where txid=?");
    $sql->execute(array($transaction));
    if($sql->rowCount()==0){
        $sql=$dbh->prepare("INSERT INTO smme_admin_transaction(`smmeid`,`txid`,`reason`,`amount`,`opfrom`,`ipaddress`,`adminnotification`,`operation`) VALUES(?,?,?,?,?,'".$_SERVER['REMOTE_ADDR']."',?,?)");
        if($sql->execute(array($profile['smmeid'],$transaction,'Paytm Deposit',$amount,'paytm',1,"+"))){
            $admintxid=$dbh->lastInsertId();
            $nowbal=$profile['balance']+$amount;
            $sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`admintxid`)values(?,?,?,?,?,?,?)");
            if($sql->execute(array($profile['smmeid'],$profile['balance'],$amount,$nowbal,"+",$_SERVER['REMOTE_ADDR'],$admintxid))){

                $sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
                $sql->execute(array($nowbal,$profile['smmeid']));
            }
        }
        return "Payment has been added to your account";
    }else {
        return "We can't process this request. Please write a ticket";
    }
}

function addbalancepaytm($transaction,$amount){
    global $dbh;
    $profile=$this->profiledetails($_SESSION['smmebhaveshsitelike']);
    $sql=$dbh->prepare("select * from smme_admin_transaction where txid=?");
    $sql->execute(array($transaction));
    $ip = $_SERVER['REMOTE_ADDR'];
    if($sql->rowCount()==0){
        $sql=$dbh->prepare("INSERT INTO smme_admin_transaction(`smmeid`,`txid`,`reason`,`amount`,`opfrom`,`ipaddress`,`adminnotification`,`operation`) VALUES(?,?,?,?,?,?,?,?)");
        if($sql->execute(array($profile['smmeid'],$transaction,'Paytm Deposit',$amount,'paytm',$ip,1,"+"))){
            $admintxid=$dbh->lastInsertId();
            $nowbal=$profile['balance']+$amount;
            $sql=$dbh->prepare("insert into smme_users_transactions(`smmeid`,`bbalance`,`amount`,`abalance`,`perform`,`ipaddress`,`admintxid`)values(?,?,?,?,?,?,?)");
            if($sql->execute(array($profile['smmeid'],$profile['balance'],$amount,$nowbal,"+",$ip,$admintxid))){
                $sql=$dbh->prepare("update smme_users_wallet set balance=? where smmeid=?");
                $sql->execute(array($nowbal,$profile['smmeid']));
            }
        }
        return "Payment has been added to your account";
    }else {
        return "We can't process this request. Please write a ticket";
    }
}

}

?>
