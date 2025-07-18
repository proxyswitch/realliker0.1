<?php require_once("common.class.php");
class usersapi extends common{
function getrocords($searchterms,$page,$perpage){
$query="";
if($searchterms!=""){
$query="and smmeid='".$searchterms."'";	
}
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select d.*,e.email from smme_users_api d,smme_users e where d.smmeid=e.id ".$query." order by d.id desc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select d.*,e.email from smme_users_api d,smme_users e where d.smmeid=e.id ".$query."");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}
function enable($id){
echo $id;	
global $dbh;	
$sql=$dbh->prepare("update smme_users_api set status=? where id=?");
$sql->execute(array(1,$id));
print_r($sql->errorInfo());
}
function disable($id){
echo $id;	
global $dbh;	
$sql=$dbh->prepare("update smme_users_api set status=? where id=?");
$sql->execute(array(0,$id));
print_r($sql->errorInfo());

}
}
?>