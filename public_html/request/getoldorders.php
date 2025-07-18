<?php error_reporting(0); 
require_once("../oldincludes/functions.php");
global $dbh1;
$cserver=new smmexchange();
$profile=$cserver->profiledetails($_SESSION['smmebhaveshsitelike']);
$userid=$profile['uid'];
if($_POST['process']=="getrecord"){
$patterns = array();
$page=$_POST['page'];
$cur_page=$page; 
$page -=1;
$perpage=10;
$start=$page*$perpage;
$msgs="";
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Orderid</th>
<th>Type</th>
<th>Price</th>
<th>Username/Url</th>
<th>Begin/End</th>
<th>Status</th>
<th>Start/Complete</th>
<th>Remind</th>
<th>Payment Status</th>
</tr>
</thead>   
<tbody>';
$sql=$dbh1->prepare("select * from tbl_order where userid=? order by id desc limit $start, $perpage");
$sql->execute(array($userid));
if($sql->rowCount()>0){
$i=1;
while($row=$sql->fetch()){ 
$orderid=$row['orderid'];
$count=$row['count'];
$type=$row['type'];
$price=$row['price'];
$url=$row['url'];
$errortext=$row['errortext'];
$starttime=$row['date'];
$finishtime="";	
$status=$row['status'];	
if($row['status']==""){
$update4=$dbh1->prepare("update tbl_order set status='Processing' where orderid=?");
$update4->execute(array($row['orderid']));
$status="processing";
}else {
$status=$row['status'];	
}
$stcurcom=$row['startcount']."/&nbsp;".$row['finishcount'];
$remained=$row['count'];
if($row['Revertbalance']==""){	
$paymentstatus="Complete";
}else {
$paymentstatus="$".$row['Revertbalance']." "."Payment Revert (".$row['refundreason'].")";
}
$msgs.='<tr>
<td>'.$orderid.'</td>
<td class="center">'.$count." ".$type.'</td>
<td class="center">$'.$price.'</td>
<td class="center">
<span class="label label-success">'.$url.'</span><br>'.$errortext.'</td>
<td class="center">'.$starttime.'<br>'.$finishtime.'</td>
<td class="center">'.$status.'</td>
<td class="center">'. $stcurcom.'</td>
<td class="center">'.$remained.'</td>
<td class="center">'.$paymentstatus.'</td>
</tr>';
$i++;
}
}
$msgs.='</tbody></table>';
$update8=$dbh1->prepare("SELECT COUNT(*) AS count from tbl_order where userid=?");
$update8->execute(array($userid));	
$result=$update8->fetch();
$count=$result['count'];
$pagination=ceil($count/$perpage);
if($cur_page>7){
$start_page=$cur_page-3;
if($pagination>$cur_page+3)
$end_page=$cur_page+3;
if($cur_page<=$pagination && $cur_page>$pagination-6){
$start_page=$pagination-6;
$end_page=$pagination;
}
else{
$end_page=$cur_page+3;
}
}
else{
$start_page=1;
if($pagination>7)
$end_page=7;
else
$end_page=$pagination;
}
$msgs.='<div class="orderpagination" ><ul class="pagination">';
// Enable First button
if($cur_page>1){
$msgs.='<li class="active" p="1"  >First</li>';
}
else{
$msgs.='<li class="inactive"  >First</li>';
}	  
//Enabling brevious button
if($cur_page>1){
$pre=$cur_page-1;
$msgs.='<li class="active" p="'.$pre.'"   >Previous</li>';
}
else{
$msgs.='<li class="inactive" >Previous</li>';
}
for($i=$start_page; $i<=$end_page; $i++){
if($cur_page==$i)
{
$msgs.='<li class="inactive" p='.$i.' id="current"   >'.$i.'</li>';
}
else{
$msgs.='<li class="active" p="'.$i.'"   >'.$i.'</li>';
}
}
 //Enabling next button
if($cur_page<$pagination)
{
$next=$cur_page+1;
$msgs.='<li class="active" p="'.$next.'"   >Next</li>';  
}
else
{
$msgs.='<li class="inactive" >Next</li>';  
}
 // Enable end button

if($cur_page<$pagination){
$msgs.='<li class="active" p="'.$pagination.'"   >Last</li>';
}
else
{
$msgs.='<li class="inactive" >Last</li>';
}
echo $msgs;
}