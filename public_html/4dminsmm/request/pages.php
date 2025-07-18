<?php require_once("../class/pages.class.php");
$admin=new pages();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Page Name</th>
<th>Created Date</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>';

foreach($res[0] as $rows){
$msgs.='<tr>
<td>'.$rows['pagename'].'</td>
<td>'.date("d-m-y",strtotime($rows['cdate'])).'</td>
<td class="center act" >
<span class="edit option" id="'.$rows['id'].'" pagename="'.$rows['pagename'].'">Edit</span>
<span class="delete option" id="'.$rows['id'].'">Delete</span>
</td></tr>';
}
$msgs.='</tbody></table>';
$msgs.=$res[1];
}
echo $msgs;
}
elseif($_POST['process']=="addpage"){	
echo $admin->addpage($_POST['pagename'],$_POST['content']);
}
elseif($_POST['process']=="pagedetails"){
echo $admin->pagedetails($_POST['id']);
}
elseif($_POST['process']=="updatepage"){
echo $admin->updatepage($_POST['pagename'],$_POST['content'],$_POST['id']);
}
elseif($_POST['process']=="deletepage"){ 
echo $admin->deletepage($_POST['id']);
} 
?>