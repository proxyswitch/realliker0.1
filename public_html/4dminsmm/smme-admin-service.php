<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/adminservice.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Service ( Disply User End )</h5>

<div class="commonalert text-center"></div>
<select name="searchserviceprovider" class="form-control searchserviceprovider" style="width:auto;float:left;margin-right:10px;margin-bottom:10px;">
    <option value="">All</option>
<?php
foreach($getserviceprovider as $provider){?>
    
<option value="<?=$provider['id'];?>"><?=$provider['provider'];?></option>
<?php }
?>    
</select>
<input type="button" name="create" value="New Service" id="" class="btn create" />
<input type="button" name="refresh" value="Refresh" id="refresh" class="btn refresh" />
<div id="content"></div>

<div id="editcontent"></div>

<div class="row">
<table style="display:none;" class="dummydata table">
<tbody>
<tr id="#clonegroup" >
<td>User Group</td><td>buyprice</td><td>Sell Price</td><td>Item</td><td>min count</td><td>Max count</td></tr>
<tr id="clonegroup"><td>
<select name="user" id="guser" class="user form-control">
<option value="">Select</option>
<?php foreach($userlist as $row){ ?>
<option value="<?=$row['id'];?>"><?=$row['username'];?></option>
<?php }  ?>
</select></td>
<td><select name="group" id="ggen" class="group form-control">
<?php foreach($group as $row){ ?>
<option value="<?=$row['id'];?>"><?=$row['group_name'];?></option>
<?php }  ?>
</select></td>
<td><input type="text" id="" name="" class="required number buyprice form-control" value="" /></td><td><input type="text" id="" name="" class="required number sellprice form-control" value="" /></td><td><input id="" name="" type="text" class="required number item form-control" value="" /></td><td><input id="" name="" type="text" class="required number mincount form-control" value="" /></td><td><input id="" name="" type="text" class="required number maxcount form-control" value="" /></td>
<td class="deletrow"><span class="option">Delete</span></td> </tr>
<tr id="cloneuser"><td>
</td><td><input type="text" id="" name="" class="required number buyprice" value="" /></td><td><input  id="" name=""type="text" class="required number sellprice" value="" /></td><td><input id="" name="" type="text" class="required number item" value="" /></td><td><input id="" name="" type="text" class="required number mincount" value="" /></td><td><input id="" name="" type="text" class="required number maxcount" value="" /></td>
</tr>
</tbody>
</table>
</div>

</div>
<?php include("includes/smme-footer.php");?>