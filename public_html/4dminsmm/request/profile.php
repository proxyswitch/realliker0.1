<?php require_once("../class/profile.class.php");
$admin=new profile();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>UserName</th>
<th>Email</th>
<th>Pin</th><th>Action</th></tr>
</thead>   
<tbody>';
foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['username'].'</td>
<td>'.$rows['email'].'</td>
<td>'.$rows['pin'].'</td>
<td class="center act" >
<span class="edit option" id="'.$rows['username'].'" email="'.$rows['email'].'">Edit</span>
<span class="changepin option" pin="'.$rows['pin'].'">Change Pin</span>
<span class="changepassword option">Change Password</span>
</td></tr>';
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="updatepin"){ 
$res=$admin->updatepin($_POST['pin']);
}elseif($_POST['process']=="updateadmin"){
$res=$admin->updateadmin($_POST['username'],$_POST['email']);
}
elseif($_POST['process']=="updatepassword"){
echo $res=$admin->updatepassword($_POST['oldpassword'],$_POST['password']);
}
?>