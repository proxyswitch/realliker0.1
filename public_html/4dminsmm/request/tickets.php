<?php require_once("../class/tickets.class.php");
$admin=new tickets();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Select</th>
<th>Ticket No</th>
<th>UserName</th>
<th>Name</th>
<th>Subject</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>   
<tbody>';
$i=1;
foreach($res[0] as $rows){ 
$action='<span class="edit option" ticketid='.$rows['id'].' uid='.$rows['smmeid'].'>Ticket</span>'; 
$reply='<span class="reply option" status='.$rows['status'].' ticketid='.$rows['id'].' uid='.$rows['smmeid'].'>Reply</span>';
if($rows['status']=="0"){
$status="Open";
}else {
$status="Closed";	
}
$newlink="";
if($rows['noti']==1){	
$newlink='<img src="../../img/icon_new.gif">';
}
$msgs.='<tr>
<td><input type="checkbox" class="tdeleteid" value='.$rows['id'].'></td>
<td>'.$rows['id'].'</td>
<td>'.$rows['username'].'</td>
<td>'.$rows['name'].'</td>
<td>'.$rows['subject'].'</td>
<td>'.$status.'&nbsp;'.$newlink.'</td>
<td>'.date("d-m-Y h:i:s a",strtotime($rows['cdate'])).'</td>
<td>'.$action.' &nbsp;'.$reply.'</td></tr>';
$i++;
}$msgs.='</tbody></table>';
$msgs.=$res[1];
$msgs.='<div class="statustable">
<input type="button" class="selectall btn" value="Select All">
<input type="button" class="deselectall btn" value="Deselect All">
<input type="button" class="tdelete btn" value="Delete">
</div>';
}else{
$msgs.="<p class='text-center message'>".$res."</p>";	
}
echo $msgs;
}
elseif($_POST['process']=="viewtickets"){
$res=$admin->viewticket($_POST['ticketid']);	
$msg='
<table class="table ticketsubject">
<tr><th>Created Date</th><th>Subject</th></tr>
<tr><td>'.date("d-m-y h:i:s a",strtotime($res[0]['cdate'])).'</td><td>'.$res[0]['subject'].'</td></tr>
</table>
';
$msg.='
<table class="table ticketconver">
<tr><th>Conversation</th></tr>
<tr><th>Date</th><th>Message</th></tr>';	
foreach($res[1] as $recrods){
if($recrods['from']==0){
$from="User";	
}else {
$from="Admin";	
}	
$msg.='
<tr><td>'.date("d-m-y h:i:s a",strtotime($recrods['tcdate'])).'</td><td>'.$recrods['content'].'</td></tr>';	
}
$msg.='</table>';
echo $msg;
}
elseif($_POST['process']=="updateticket"){
$res=$admin->updateticket($_POST['ticketid'],$_POST['content'],$_POST['status']);	
echo $res;
}
elseif($_POST['process']=="deleteticket"){
$res=$admin->deletetickets($_POST['ids']);	
}
?>