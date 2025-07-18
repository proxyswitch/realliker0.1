<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/notification.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Notification</h5>
<div class="commonalert text-center"></div>
<input type="button" name="create" value="New Page" id="" class="btn create" />
<input type="button" name="refresh" value="Refresh" id="refresh" class="btn refresh" />
<div id="content"></div>
<div class="editgroupbox dialog" style="display:none;">
<form name="upgroup" class="upgroup" method="post">
<input type="hidden" name="process" value="updatenotification">
<div class="form-group">
<label>Content</label>
<textarea name="content" class="required form-control" id="content"></textarea>
</div>
<div class="form-group">
<label>Status</label>
<select name="status" class="form-control" id="status">
<option value="0">Activated</option>
<option value="1">De-Activated</option>
</select>
</div>

<input type="hidden" name="id" value="" id="id" />
<div class="text-center">
<input type="submit" name="Proceed" value="Proceed" class="btn">
</div>
<div class="alert text-center message"></div>
</form>
</div>
<div class="creategroupbox dialog" style="display:none;">
<form name="creategroup" class="creategroup">
<div class="form-group">
<label>Content</label>
<textarea name="content" class="required form-control" id="content"></textarea>
<input type="hidden" name="process" value="addnotification">
</div>
<div class="form-group">
<label>Status</label>
<select name="status" class="form-control">
<option value="0">Activated</option>
<option value="1">De-Activated</option></select></div>
<div class="text-center">
<input type="submit" name="Proceed" value="Proceed" class="btn addservice"></div>
<div class="alert text-center message"></div>
</form>
</div>
</div>
<?php include("includes/smme-footer.php");?>