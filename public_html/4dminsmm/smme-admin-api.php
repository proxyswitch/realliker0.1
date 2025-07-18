<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/api.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Admin Profile</h5>
<div class="commonalert text-center"></div>
<input type="button" name="create" id="create" value="New Api" class="btn" />
<div id="content"></div>
<div class="createapibox dialog" style="display:none;">
<form name="createapi" class="createapi">
<div class="form-group">
<label>Api Name</label>
<input type="text" name="apiname" id="apiname" value="" class="form-control required"/>
</div>
<div class="form-group">
<label>Key</label>
<input type="text" name="key" id="key" value="" class="form-control required" />
<input type="hidden" name="process" value="addapi" />
</div>
<div class="text-center">
<input type="submit" class="btn" value="Add" name="Add">
</div>
</form>
</div>


<div class="updateapibox dialog" style="display:none;">
<form name="updateapi" class="updateapi">
<div class="form-group">
<label>Api Name</label>
<input type="text" name="apiname" id="apiname" value="" class="form-control required"/>
</div>
<div class="form-group">
<label>Key</label>
<input type="text" name="key" id="key" value="" class="form-control required" />
<input type="hidden" name="process" value="updateapi" />
<input type="hidden" name="id" id="id" value="" />
</div>
<div class="text-center">
<input type="submit" class="btn" value="Update" name="update">
</div>
</form>
</div>
</div>
<?php include("includes/smme-footer.php");?>