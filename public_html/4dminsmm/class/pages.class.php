<?php require_once("common.class.php");
class pages extends common{
function getrocords($searchterms,$page,$perpage){
$cur_page=$page; 	
$page -=1;	
$start=$page*$perpage;	
global $dbh;	 
$sql=$dbh->prepare("select * from smme_site_pages order by id asc limit $start,$perpage");
$sql->execute();
$rowcount=$sql->rowCount();	 
if($rowcount>0){
$res=$sql->fetchAll();
$psql=$dbh->prepare("select * from smme_site_pages");
$psql->execute();	  
$rowcount1=$psql->rowCount();		  
$pagin=$this->pagination($rowcount1,$perpage,$cur_page,"","managegroup");	
return array($res,$pagin);
}else {
echo "<center>No record found</center>";
}	
}

function updatepage($pagename,$content,$id){
global $dbh;
$sql=$dbh->prepare("select * from smme_site_pages where pagename=? and id!=?");	
$sql->execute(array($pagename,$id));
$rowcount=$sql->rowCount();
if($rowcount==0){
$sql=$dbh->prepare("update smme_site_pages set pagename=?,content=? where id=?");	
$sql->execute(array($pagename,$content,$id));
return 0;
}else{
return 1;	
}
}
function pagedetails($id){
global $dbh;	
$sql=$dbh->prepare("select * from smme_site_pages where id=?");
$sql->execute(array($id));
$res=$sql->fetch();
return $res['content'];
}

function deletepage($id){
global $dbh;
$sql=$dbh->prepare("delete from smme_site_pages where id=?");	
$sql->execute(array($id));
return "deleted successfully";
}

function addpage($pagename,$content){
global $dbh;	
$sql=$dbh->prepare("select * from smme_site_pages where pagename=?");
$sql->execute(array($pagename));
if($sql->rowCount()==0){
$sql=$dbh->prepare("insert into smme_site_pages(`pagename`,`content`)values(?,?)");
$sql->execute(array($pagename,$content));
return "Page has been created";
}else{
return "1";
} 
}
}
?>