<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/users.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Users</h5>
<div class="commonalert text-center"></div>
<div class="row">
<div class="searchbox col-lg-4 col-xs-offset-4">
<form name="searchform" class="searchform">
<div class="form-group">
<label>Search by username / email</label>
<input type="text" name="search" id="search" value="" class="form-control required">
</div>
<div class="text-center">
<input type="button" name="searchbtn" id="searchbtn" class="searchbtn btn" value="Search">
<input type="reset" name="clear" class="btn" value="Clear">
<input type="button" name="refresh" id="refresh" value="Refresh" class="btn">
<input type="button" name="newuser" id="createuser" value="New User" class="btn">
</div>
</form>
</div>
</div>
<div id="content"></div>
<div class="showbalance dialog" style="display:none;">
<form name="makebalance" class="makebalance" method="post">
<div class="form-group">
<label>Email</label>
<input type="text" name="username" id="username" value="" class="required form-control"></div>
<input type="hidden" name="process" value="makebalance">
<div class="form-group">
<label>Enter Amount</label>
<input type="text" name="amt" id="amt" value="" class="required form-control">
</div>
<div class="form-group">
<label>Operaton</label>
<select name="operation" class="required form-control" id="operation">
<option value="add">+</option>
<option value="sub">-</option>
</select></div>
<div class="form-group">
<label>Enter Reason</label>
<textarea name="reason" id="reason" class="required form-control" rows="5"></textarea>
</div>
<div class="text-center">
<input type="submit" name="Proceed" value="Proceed" class="btn">
</div>
</form>
<div class="alert"></div>
</div>
<div class="passwordupdate dialog" style="display:none;">
<form name="uppassword" class="uppassword" method="post">
<div class="form-group">
<label>Password</label>
<input type="hidden" name="upid" id="upid" value="" class="required">
<input type="hidden" name="process" value="changepassword">
<input type="text" name="unpass" id="unpass" value="" class="required form-control">
</div>
<div class="form-group">
<input type="submit" name="Proceed" value="Proceed" class="btn">
</div>
<div class="alert"></div>
</form>
</div>
<div class="profilecreate dialog" style="display:none;">
<form name="createprofile" class="createprofile" method="post">
<div class="col-md-12">
<div class="form-group">
<label>Email</label>
<input type="text" name="email" id="email" value="" class="required email form-control">
<input type="hidden" name="process" value="createuser">
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password"  id="userpass" value="" class="required form-control">
</div>

<div class="form-group">
<label>Name</label>
<input type="text" name="name" id="name" value="" class="required form-control">
</div>
<div class="form-group">
<label>Skype</label>
<input type="text" name="skype" id="mono" value="" class="form-control"></div>
<div class="form-group">
<label>Group</label>
<select name="group" class="required form-control"  id="group">
<?php foreach($group as $groups){ ?>
<option value="<?=$groups['id'];?>"><?=$groups['group_name'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>Status</label>
<select name="status" class="required form-control" id="activate">
<?php foreach($status as $activate){ ?>
	<option value="<?=$activate['stid'];?>"><?=$activate['status'];?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label>2Checkout</label>
<select name="pcheckout" class="required form-control" id="pcheckout">
	<option value="0">No</option>
<option value="1">Yes</option>

</select>
</div>

<div class="form-group">
<label>2chockout Payment Update</label>
<select name="checkoutauto" class="required form-control" id="checkoutauto">
<option value="0">No</option>
<option value="1">Yes</option>
</select>
</div>



<div class="form-group">
<label>Paypal Payment Update</label>
<select name="paypalauto" class="required form-control" id="paypalauto">
<option value="0">No</option>
<option value="1">Yes</option>
</select>
</div>


</div>
<div class="col-md-12">
<div class="form-group text-center">
<input type="submit" name="Proceed" value="Proceed" class="btn">
<input type="reset" name="reset" value="Clear" class="btn" />
</div>
</div>
<div class="useralert text-center message"></div>
<div class="alert"></div>
</form>

</div>
<div class="profileupdate dialog" style="display:none;">
<form name="upprofile" class="upprofile" method="post">
<div class="col-md-12">
<div class="form-group">
<input type="hidden" name="uid" id="uid" value="" />
<label>UserName</label>
<input type="text" name="username" id="username" value="" class="required form-control">
</div>
<div class="form-group">
<label>Email</label>
<input type="text" name="email" id="email" value="" class="required email form-control"></div>
<input type="hidden" name="process" value="editprofile">
<div class="form-group">
<label>Name</label>
<input type="text" name="name" id="name" value="" class="required form-control"></div>
<div class="form-group">
<label>Skype</label>
<input type="text" name="skype" id="mono" value="" class="form-control"></div>
<div class="form-group">
<label>Group</label>
<select name="group" class="required form-control" id="group">
<?php foreach($group as $groups){ ?>
	<option value="<?=$groups['id'];?>"><?=$groups['group_name'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>Status</label>
<select name="status" class="required form-control" id="activate">
<?php foreach($status as $activate){ ?>
<option value="<?=$activate['stid'];?>"><?=$activate['status'];?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label>2Checkout</label>
<select name="pcheckout" class="required form-control" id="pcheckout">
	<option value="0">No</option>
<option value="1">Yes</option>

</select>
</div>

<div class="form-group">
<label>2chockout Payment Update</label>
<select name="checkoutauto" class="required form-control" id="checkoutauto">
<option value="0">No</option>
<option value="1">Yes</option>
</select>
</div>



<div class="form-group">
<label>Paypal Payment Update</label>
<select name="paypalauto" class="required form-control" id="paypalauto">
<option value="0">No</option>
<option value="1">Yes</option>
</select>
</div>




</div>
<div class="col-md-12 text-center">
<div class="form-group">
<input type="submit" name="Proceed" value="Proceed" class="btn">
</div>
</div>
<div class="alert text-center message"></div>
</form>
</div>
</div>
<?php include("includes/smme-footer.php");?>