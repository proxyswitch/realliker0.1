<?php require_once("../class/notification.class.php");
$admin=new notification();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Notification Details</th>
<th>Status</th>
<th>Created Date</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>';
foreach($res[0] as $rows){
if($rows['status']==0){
$status="Activated";
}else{
$status="De-Activated";
}
$msgs.='<tr>
<td>'.$rows['content'].'</td>
<td>'.$status.'</td>
<td>'.date("d-m-y h:i:s a",strtotime($rows['cdate'])).'</td>
<td class="center act" >
<span class="edit option" id="'.$rows['id'].'">Edit</span>
<span class="delete option" id="'.$rows['id'].'">Delete</span>
</td></tr>';
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="addnotification"){	
echo $admin->addnotification($_POST['content'],$_POST['status']);
}
elseif($_POST['process']=="notificationdetails"){
echo $admin->notificationdetails($_POST['id']);
}
elseif($_POST['process']=="updatenotification"){
echo $admin->updatenotification($_POST['content'],$_POST['status'],$_POST['id']);
}
elseif($_POST['process']=="deletenotification"){ 
echo $admin->deletenotification($_POST['id']);
}
?>