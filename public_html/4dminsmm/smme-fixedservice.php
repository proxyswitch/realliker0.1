<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/fixedservice.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Fixed Service ( don't delete its for deve purpose )</h5>
<div class="commonalert text-center"></div>
<input type="button" name="create" value="New Service" id="" class="btn create" />
<input type="button" name="refresh" value="Refresh" id="refresh" class="btn refresh" />
<div id="content"></div>
<div class="editgroupbox dialog" style="display:none;">
<form name="upgroup" class="upgroup" method="post">
<div class="form-group">
<label>Provider</label>
<select name="provider" class="required provider form-control" id="provider">
<?php foreach($getserviceprovider as $provider){?>
<option value="<?=$provider['id'];?>"><?=$provider['provider'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>Service Name</label>
<input type="text" name="service" id="service" value="" class="required form-control">
</div>

<input type="hidden" name="id" value="" id="id" />
<div class="form-group">
<input type="submit" name="Proceed" value="Proceed" class="btn">
</div>
<div class="alert text-center message"></div>
</form>
</div>
<div class="creategroupbox dialog" style="display:none;">
<form name="creategroup" class="creategroup">
<div class="form-group">
<label>Provider</label>
<select name="provider" class="required provider form-control" id="provider">
<?php foreach($getserviceprovider as $provider){?>
<option value="<?=$provider['id'];?>"><?=$provider['provider'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>Service Name</label>
<input type="text" name="service" id="service" value="" class="required form-control">
</div>
<div class="form-group">
<input type="button" name="Proceed" value="Proceed" class="btn addservice"></div>
<div class="alert text-center message"></div>
</form>
</div>
</div>
<?php include("includes/smme-footer.php");?>