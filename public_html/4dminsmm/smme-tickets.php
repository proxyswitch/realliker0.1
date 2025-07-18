<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/tickets.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Tickets</h5>
<div class="commonalert text-center"></div>
<div class="col-md-3 col-xs-offset-4 searchbox">
<div class="form-group">
<label>User</label><select name="suser" class="nselect form-control" id="suser">
<option value="">Select</option>
<?php
foreach($userlist as $users){?>
<option value="<?=$users['id'];?>"><?=$users['username'];?></option>
<?php } ?>
</select>
</div>
<div class="form-group">
<label>Status</label><select name="status" class="nselect form-control" id="status">
<option value="">Select</option>
<option value="0">Open</option>
<option value="1">Closed</option>
</select>
</div>
<div class="text-center">
<input type='button' value='Search' id='searchbtn' class='btn'>
<input type='button' value='Refresh' id='refresh' class='btn'>
</div>
</div>
<div id="content"></div>
<div class="replybox dialog" style="display:none;">

</div>
<div class="replyarea dialog" style="display:none;">
<form name="upreply" class="upreply">
<div class="form-group">
<input type="hidden" value="" id="ticketid">
<label>Reply TO User</label>
<textarea name="replycomment" id="replycomment" class="required form-control" rows="10" cols="50"></textarea>
</div>
<div class="form-group">
<label>Status</label><select name="tstatus" id="tstatus" class="nselect form-control" >
<option value="0">Open</option>
<option value="1">Closed</option>
</select>
</div>
<div class="form-group">
<input type="submit" class="btn" value="Reply" name="reply">
</div>
</form>

</div>
</div>
<?php include("includes/smme-footer.php");?>