<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/serviceprovider.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Social Providers</h5>
<div class="commonalert text-center"></div>
<input type="button" name="create" value="New Provider" id="" class="btn create" />
<input type="button" name="refresh" value="Refresh" id="refresh" class="btn refresh" />
<div id="content"></div>
<div class="editgroupbox dialog" style="display:none;">
<form name="upgroup" class="upgroup" method="post">
<div class="form-group">
<input type="hidden" name="groupid" id="groupid" disabled value="" class="required">
<label>Provider Name</label>
<input type="text" name="groupname" id="groupname" value="" class="required form-control">
</div>
<div class="form-group">
<input type="submit" name="Proceed" value="Proceed" class="btn">
</div>
<div class="alert text-center message"></div>
</form>
</div>
<div class="creategroupbox dialog" style="display:none;">
<form name="creategroup" class="creategroup">
<div class="form-group">
<label>Provider Name</label>
<input type="text" name="newgroup" id="newgroup" value="" class="required form-control">
</div>
<div class="form-group">
<input type="button" name="Proceed" value="Proceed" class="addgroup btn"></div>
<div class="alert text-center message"></div>
</form>
</div>
</div>
<?php include("includes/smme-footer.php");?>