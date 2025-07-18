<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/autoorders.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Auto Orders</h5>
<div class="row">
<div class="col-md-6 col-md-offset-3 searchbox">
<div class="form-group">
<label>Auto Oder No</label><input type="text" class="ninput form-control" name="orderno" id="orderno" value=""  />
</div>
<div class="form-group">
<label>Instagram Username</label><input type="text" class="ninput form-control" name="slink" id="slink" value=""  />
</div>
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
<?php foreach($autoorderstatus as $ostatus){?>
<option value="<?=$ostatus['id'];?>"><?=$ostatus['status'];?></option>
<?php } ?>
</select>
</div>
<div class="text-center">
<input type="button" id="searchbtn" value="Search" class="btn" />
<input type="button" id="refresh" value="Refresh" class="btn" />
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="commonalert text-center"></div>
<div id="content"></div>
</div>
<?php include("includes/smme-footer.php");?>