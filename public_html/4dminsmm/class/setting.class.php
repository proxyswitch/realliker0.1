<?php require_once("common.class.php");

class setting extends common{
	
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_admin_config order by id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_admin_config");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updatesetting($skype,$fromemail,$supportemail,$paypalemail,$minimumamt,$minimumamt2){
global $dbh;
$sql=$dbh->prepare("update smme_admin_config set skype=?,fromemail=?,supportemail=?,paypalemail=?,minimum_pay=?,2minimum_pay=? where id=?");	
$sql->execute(array($skype,$fromemail,$supportemail,$paypalemail,$minimumamt,$minimumamt2,1));
}
}
?>