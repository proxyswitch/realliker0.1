<?php require_once("../class/adminservice.class.php");
$admin=new adminservice();
if($_POST['process']=="getrecords"){
$msgs="";
$res=$admin->getrocords($_POST['search'],(int)$_POST['page'],10);
if(is_array($res)){
$msgs.='<table class="ordertable table">
<thead>
<tr>
<th>Service Provider</th>
<th>Fixed Service</th>
<th>Display Name</th>
<th>Auto Order</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>';

foreach($res[0] as $rows){

if($rows['autoorder']==0){
$au="No";
}else{
$au="Yes";
}

$msgs.='<tr>
<td>'.$rows['provider'].'</td>
<td>'.$rows['service'].'</td>
<td>'.$rows['display'].'</td>	
<td>'.$au.'</td>	


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
elseif($_POST['process']=="createhtmlservice"){
$ress=$admin->selectservice(isset($_POST['id']));
$serviceproviderlist=$admin->serviceproviderlist();
$selectservicvelistbyprovider=$admin->servicelistbyprovider($ress['site']);
$userdetails=$admin->allusers();
$pricelist=$admin->getpricedetails((int)$ress['id']);
$groupdetails=$admin->usergroup();
$apikeylist=$admin->activeapikeys();
?>
<div class="searchbox">
<form class="form-horizontal" method="post" action="" name="addrecord" id="serviceform">
<div class="col-md-3 col-md-offset-4">
<div class="form-group">
<label>Provider</label>
<select name="provider" class="required providerid form-control" id="provider">
<option  value="">Select</option>   
<?php foreach($serviceproviderlist as $rows) {  ?> 
<option  value="<?=$rows['id'];?>"><?=$rows['provider'];?></option>    
<?php } ?>
</select>
</div>
<div class="form-group">
<label>service:</label>
<select name="service" class="required serviceid form-control" id="service">
<option value="">Select</option>
</select>
</div>
<div class="form-group">
<label>Dispaly Name:</label>
<input class="required displayname form-control" name="display"  type="text" value="" >
</div>
<div class="form-group">
<label>Choose Api</label>
<select name="apikey" class="required apikey form-control" id="apikey">
<?php  foreach($apikeylist as $apikey){?>
<option value="<?=$apikey['id'];?>"><?=$apikey['apiname'];?></option>
<?php 	} ?>
</select>
</div>
<div class="form-group">
<label>Auto Order :</label>
<select name="autoorder" class="autoorder form-control">
<option value="0">No</option>
<option value="1">Yes</option>
</select>
</div>
<div class="form-group">
<label>New Alert :</label>
<select name="newstatus" class="newstatus form-control">
<option value="0">No</option>
<option value="1">Yes</option>
</select>
</div>
<div class="form-group">
<label>Status:</label>
<select name="status" class="status form-control">
<option value="Active">Active</option>
<option value="Inactvie">Inactive</option>
</select>
</div>
</div>
<table class="grouptable ordertable table">
<tbody>
<tr>
<td>User</td><td>User Group</td><td>buyprice</td><td>Sell Price</td><td>Item</td><td>min count</td><td>Max count</td><td>Action</td></tr>
<tr>  
<td><select name="user" id="guser" class="user form-control">
<option value="">Select</option>
<?php foreach($userdetails as $row){ ?>
<option value="<?=$row['id'];?>"><?=$row['username'];?></option>
<?php }  ?>
</select></td>
<td><select name="group" id="ggen" class="group form-control">
<?php foreach($groupdetails as $row){ ?>
<option value="<?=$row['id'];?>"><?=$row['group_name'];?></option>
<?php }  ?>
</select>
</td><td><input type="text" id="buyprice" name="buyprice" class="required number buyprice form-control" value="" /></td><td><input type="text" name="sellprice" id="sellprice" class="required number sellprice form-control" value="" /></td><td><input type="text" name="item" id="item" class="required number item form-control" value="" /></td><td><input type="text" name="mincount" id="mincount" class="required number mincount form-control" value="" /></td><td><input type="text" name="maxcount" id="maxcount" class="required number maxcount form-control" value="" /></td>
<td class="deletrow"><span class="option">Delete</span></td></tr> 
</tbody>
</table>
<input  type="button" name="addgroup" class="addgroup mybutton btn" value="Add Group" />  
<input type="button" class="save mybutton btn" name="sub" value="Create">
<input type="reset" class="mybutton btn serviceclose" value="Back" /> 
</form>
</div>
<?php 
} 
elseif($_POST['process']=="selectservice"){
$selectservicvelistbyprovider=$admin->servicelistbyprovider($_POST['provider']); ?>
<option value="">Select</option>	
<?php	
foreach($selectservicvelistbyprovider as $row){ ?>
<option value="<?=$row['id'];?>"><?=$row['service'];?></option>	
<?php }
}
elseif($_POST['process']=="selectusergroup"){
$result=$admin->selectusergroup((int)$_POST['user']);
echo (int)$result['groups'];
}
elseif($_POST['process']=="createservice"){
print_r($_POST);
$id=$admin->createservice($_POST['displayname'],$_POST['providerid'],$_POST['serviceid'],$_POST['status'],$_POST['apiprovider'],$_POST['autoorder'],$_POST['newstatus']);		
$userid=explode(',',$_POST['userid']);
$groupid=explode(',',$_POST['groupid']);	
$buyprice=explode(',',$_POST['buyprice']);
$sellprice=explode(',',$_POST['sellprice']);
$item=explode(',',$_POST['item']);
$mincount=explode(',',$_POST['mincount']);
$maxcount=explode(',',$_POST['maxcount']);
$arrayall=array_map(null,$userid,$groupid,$buyprice,$sellprice,$item,$mincount,$maxcount); 
foreach($arrayall as $servicedetails){
$admin->addprice($id,$_POST['providerid'],$_POST['serviceid'],$servicedetails[0],$servicedetails[1],$servicedetails[2],$servicedetails[3],$servicedetails[4],$servicedetails[5],$servicedetails[6]);		
}
}
else if($_POST['process']=="deleteservice"){
echo $admin->deleteservice($_POST['service']);	
}
else if($_POST['process']=="editservice"){
$ress=$admin->selectservice((int)$_POST['id']);
$serviceproviderlist=$admin->serviceproviderlist();
$selectservicvelistbyprovider=$admin->servicelistbyprovider($ress['site']);
$userdetails=$admin->allusers();
$pricelist=$admin->getpricedetails((int)$ress['id']);
$groupdetails=$admin->usergroup();
$apikeylist=$admin->activeapikeys();
?>
<div class="searchbox">
<form class="form-horizontal" method="post" action="" name="addrecord" id="serviceform">
<div class="col-md-3 col-md-offset-4">
<input type="hidden" class="editid" value="<?=$_POST['id'];?>" />
<div class="form-group">
<label>Provider</label>
<select name="provider" class="required providerid form-control" id="provider">
<option  value="">Select</option>   
<?php foreach($serviceproviderlist as $rows) {  ?> 
<option <?php  if($ress['site']==$rows['id']){?> selected="selected"<?php }?>  value="<?=$rows['id'];?>"><?=$rows['provider'];?></option>    
<?php } ?>
</select>
</div>
<div class="form-group">
<label >service:</label>
<select name="service" class="required serviceid form-control" id="service">
<?php  foreach($selectservicvelistbyprovider as $rows){
?>
<option <?php  if($ress['service']==$rows['id']){?> selected="selected"<?php } ?> value="<?=$rows['id'];?>"><?=$rows['service'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>Dispaly Name:</label>
<input class="required displayname form-control" name="display"  type="text" value="<?=$ress['display']?>" >
</div>
<div class="form-group">
<label>Choose Api</label>
<select name="apikey" class="required apikey form-control" id="apikey">
<?php  foreach($apikeylist as $apikey){?>
<option <?php  if($ress['api']==$apikey['id']){?> selected="selected"<?php }?> value="<?=$apikey['id'];?>"><?=$apikey['apiname'];?></option>
<?php 	} ?>
</select>
</div>
<div class="form-group">
<label>Auto Order :</label>
<select name="autoorder" class="autoorder form-control">
<option <?php if($ress['autoorder']=="1"){?> selected="selected"<?php } ?>value="1">Yes</option>
<option  <?php if($ress['autoorder']=="0"){?> selected="selected"<?php } ?> value="0">No</option>
</select>
</div>
<div class="form-group">
<label>New Alert :</label>
<select name="newstatus" class="newstatus form-control">
<option <?php if($ress['newstatus']=="1"){?> selected="selected"<?php } ?>value="1">Yes</option>
<option  <?php if($ress['newstatus']=="0"){?> selected="selected"<?php } ?> value="0">No</option>
</select>
</div>

<div class="form-group">
<label>Status:</label>
<select name="status" class="status form-control">
<option <?php if($ress['status']=="Active"){?> selected="selected"<?php } ?>value="Active">Active</option>
<option  <?php if($ress['status']=="Inactive"){?> selected="selected"<?php } ?> value="Inactive">Inactive</option>
</select>
</div>
</div>
<table class="grouptable ordertable table">
<tbody>
<tr>
<td>User</td><td>User Group</td><td>buyprice</td><td>Sell Price</td><td>Item</td><td>min count</td><td>Max count</td><td>Action	</td>
</tr>
<?php foreach($pricelist as $prresult){
?>
<tr>  
<td>  <select name="user" id="guser" class="user form-control">
<option value="">Select</option>
<?php foreach($userdetails as $row){ ?>
<option <?php if($prresult['userid']==$row['id']){ ?> selected="selected"<?php } ?> value="<?=$row['id'];?>"><?=$row['username'];?></option>
<?php }  ?>
</select></td>
<td><select name="group" id="ggen" class="group form-control">
<?php foreach($groupdetails as $row){ ?>

<option <?php if($prresult['user_group']==$row['id']){ ?> selected="selected"<?php } ?> value="<?=$row['id'];?>"><?=$row['group_name'];?></option>
<?php }  ?>
</select>
</td><td><input type="text" class="required number buyprice form-control" value="<?=$prresult['buyprice'];?>" /></td><td><input type="text" class="required number sellprice form-control" value="<?=$prresult['sellprice'];?>" /></td><td><input type="text" class="required number item form-control" value="<?=$prresult['per_item'];?>" /></td><td><input type="text" class="required number mincount form-control" value="<?=$prresult['min_order'];?>" /></td><td><input type="text" class="required number maxcount form-control" value="<?=$prresult['max_order'];?>" /></td>
<td class="deletrow"><span class="option">Delete</span></td>     </tr>
<?php } ?> 
</tbody>
</table>
<div class="but">
<input  type="button" name="addgroup" class="addgroup mybutton btn" value="Add Group" />  
<input type="button" class="editsave mybutton btn" name="sub"  value="Update">
<input type="reset" class="mybutton btn serviceclose" value="Back" /> 
</div>
</form>
</div>
<?php 
}
elseif($_POST['process']=="updateservice"){
print_r($_POST);
$id=$_POST['editid'];
$admin->updateservicetbl($_POST['displayname'],$_POST['providerid'],$_POST['serviceid'],$_POST['status'],$_POST['editid'],$_POST['apiprovider'],$_POST['autoorder'],$_POST['newstatus']);
$admin->deletepricebyservice($id);
$userid=explode(',',$_POST['userid']);
$groupid=explode(',',$_POST['groupid']);	
$buyprice=explode(',',$_POST['buyprice']);
$sellprice=explode(',',$_POST['sellprice']);
$item=explode(',',$_POST['item']);
$mincount=explode(',',$_POST['mincount']);
$maxcount=explode(',',$_POST['maxcount']);
$arrayall=array_map(null,$userid,$groupid,$buyprice,$sellprice,$item,$mincount,$maxcount); 
foreach($arrayall as $servicedetails){
$admin->addprice($id,$_POST['providerid'],$_POST['serviceid'],$servicedetails[0],$servicedetails[1],$servicedetails[2],$servicedetails[3],$servicedetails[4],$servicedetails[5],$servicedetails[6]);	

}
}

