<?php require_once("userprofile.class.php");
class oldcommon extends profile{
public function __construct(){
if(!isset($_SESSION['smmebhaveshsitelike']) && $_SESSION['smmebhaveshsitelike']==""){
header("location:index.php");	
}
}
function oldorderstatuslist(){
global $dbh1;
$sql=$dbh1->prepare("select * from tbl_orderstatus");
$sql->execute();
$res=$sql->fetchAll();
return $res;	
}

}