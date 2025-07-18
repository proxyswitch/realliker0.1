<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/orders.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Orders</h5>
<div class="row">
<div class="col-md-6 col-md-offset-3 searchbox">
<div class="form-group">
<label>Oder No</label><input type="text" class="ninput form-control" name="orderno" id="orderno" value=""  />
</div>
<div class="form-group">
<label>Url</label><input type="text" class="ninput form-control" name="slink" id="slink" value=""  />
</div>
<div class="col-md-6">
<div class="form-group">
<label>From Date</label> <input type="text" name="fdate " class="dinput date form-control" id="fdate" value="" /> 
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>To Date</label><input type="text" name="tdate " class="dinput date form-control" id="tdate" value="" />
</div>
</div>
<div style="clear:both;"></div>
<div class="form-group">
<label>Service</label><select name="sservice" class="nselect form-control" id="sservice">
<option value="">Select</option>
<?php
foreach($servicelist as $service){?>
<option value="<?=$service['id'];?>"><?=$service['display'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>User</label><select name="suser" class="nselect form-control" id="suser">
<option value="">Select</option>
<?php
foreach($userlist as $users){?>
<option value="<?=$users['id'];?>"><?=$users['email'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>Status</label><select name="pstatus" id="pstatus" class="nselect form-control" >
<option value="">Select</option>
<?php foreach($orderstatus as $ostatus){?>
<option value="<?=$ostatus['id'];?>"><?=$ostatus['status'];?></option>
<?php } ?>
</select>
</div>
<div class="text-center">
<input type="button" id="searchbtn" value="Search" class="btn" />
<input type="button" id="refresh" value="Refresh" class="btn" />
<input type="button" id="downloadexcel" value="Download excel file" class="btn" />
<input type="button" id="downloadtext" value="Download text file" class="btn" />
</div>
</div>
</div>
<div class="commonalert text-center"></div>
<div id="content"></div>
<div class="updateorderdetails dialog" style="display:none;">
<form name="uporder" class="uporder" method="post">
<div class="form-group"><label>Order No</label>
<input type="text" name="name" id="orderid" disabled value="" class="required form-control">
<input type="hidden" name="orderno" value="" id="orderno" />
<input type="hidden" name="process" value="singleorderupdate" />
</div>
<div class="form-group">
<label>Count</label>
<input type="text" name="count" id="count" disabled value="" class="required form-control">
</div>
<div class="form-group">
<label>Url</label>
<input type="text" name="url" id="url" value="" class="form-control required">
</div>
<div class="form-group">
<label>Status</label>
<select name="status" class="required form-control" id="status">
<?php foreach($orderstatus as $ostatus){?>
<option value="<?=$ostatus['id'];?>"><?=$ostatus['status'];?></option>
<?php } ?></select>
</div>
<div class="form-group">
<label>Refund amount</label>
<input type="text" name="refundamount" id="refund" value="" class="form-control">
</div>
<div class="form-group">
<label>Start Count</label>
<input type="text" name="startcount" id="startcount" value="" class="form-control required">
</div>
<div class="form-group">
<label>Current / Finish Count</label>
<input type="text" name="finishcount" id="finishcount" value="" class="form-control required">
</div>
<div class="form-group"><label>Reason</label>
<input type="text" name="reason" id="reason" value="" class="form-control">
</div>

<div class="form-group">
<input type="submit" name="Proceed" value="Proceed" class="btn">
</div>
<div class="alert"></div>
</form>
</div>
</div>
<?php include("includes/smme-footer.php");?>