<?php require_once("../class/serviceprovider.class.php");
$admin=new serviceprovider();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Provider Name</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>';

foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['provider'].'</td>
<td class="center act" >
<span class="edit option" id="'.$rows['id'].'" groupname="'.$rows['provider'].'">Edit</span>
<span class="delete option" id="'.$rows['id'].'">Delete</span>
</td></tr>';

}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="updateprovider"){
echo $res=$admin->updateprovider($_POST['id'],$_POST['groupname']);
}
elseif($_POST['process']=="deleteprovider"){ 
$r=$admin->deleteprovider($_POST['id']);
echo $r;
}elseif($_POST['process']=="createprovider"){
$r=$admin->createprovider($_POST['groupname']);
echo $r;
} 
?>