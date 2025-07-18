<?php require_once("../class/users-api.class.php");
$admin=new usersapi();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Email</th>
<th>Securecode</th>
<th>Key</th>
<th>Created Date</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>   
<tbody>';
foreach($res[0] as $rows){
if($rows['status']==0){
$status="Disabled";
}else{
$status="Enabled";	
}
$msgs.='<tr>
<td>'.$rows['email'].'</td>
<td>'.$rows['secrecode'].'</td>
<td>'.$rows['api'].'</td>
<td>'.date("d-m-y h:i:s a",strtotime($rows['cdate'])).'</td>
<td>'.$status.'</td>
<td class="center act" >
<span class="enable option" id="'.$rows['id'].'">Enable</span>
<span class="disable option" id="'.$rows['id'].'">Disable</span>
</td></tr>';
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="enable"){
echo $res=$admin->enable($_POST['id']);
}
elseif($_POST['process']=="disable"){
echo $res=$admin->disable($_POST['id']);
}
?>