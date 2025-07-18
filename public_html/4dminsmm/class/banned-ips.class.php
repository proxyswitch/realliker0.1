<?php require_once("common.class.php");

class bannedips extends common{
	
function getrocords($searchterms,$page,$perpage){
$query="";
if($searchterms!=""){
$query="where ipaddress='".$searchterms."'";	
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_ip_ban_list ".$query." order by id desc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_ip_ban_list ".$query."");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function banip($ipaddress){
global $dbh;	
$sql=$dbh->prepare("insert into smme_ip_ban_list(`ipaddress`,`from`)values(?,?)");
$sql->execute(array($ipaddress,1));
}

function unbanip($id){
global $dbh;	
$sql=$dbh->prepare("delete from smme_ip_ban_list where id=?");
$sql->execute(array($id));
}

}
?>