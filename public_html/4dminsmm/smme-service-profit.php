<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/profit.js"></script>
<div class="content container">
<h5 class="text-center title">Service Profit</h5>
<div class="row">
<div class="col-md-6 col-md-offset-3 searchbox">
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
<div class="text-center">
<input type="button" id="searchbtn" value="Search" class="btn" />
<input type="button" id="refresh" value="Refresh" class="btn" />
</div>
</div>
</div>
<div class="commonalert text-center"></div>
<div id="content"></div>
</div>
<?php include("includes/smme-footer.php");?>