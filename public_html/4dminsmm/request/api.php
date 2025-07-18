<?php require_once("../class/api.class.php");
$admin=new api();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Api Provider</th>
<th>Key</th>
<th>Action</th></tr>
</thead>   
<tbody>';
foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['apiname'].'</td>
<td>'.$rows['key'].'</td>
<td class="center act" >
<span class="edit option" id="'.$rows['id'].'" apiname="'.$rows['apiname'].'" key="'.$rows['key'].'">Edit</span>
<span class="delete option" id="'.$rows['id'].'" >Delete</span>
</td></tr>';
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="updateapi"){ 
echo $admin->updateapi($_POST['apiname'],$_POST['key'],$_POST['id']);
}
elseif($_POST['process']=="addapi"){
echo $admin->addapi($_POST['apiname'],$_POST['key']);
}
elseif($_POST['process']=="deleteapi"){
echo $admin->deleteapi($_POST['id']);
}
?>