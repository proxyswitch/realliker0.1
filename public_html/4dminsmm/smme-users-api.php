<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/users-api.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Users Api</h5>
<div class="commonalert text-center"></div>
<div class="row">
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
<div class="text-center">
<input type='button' value='Search' id='search' class='btn'>
<input type='button' value='Refresh' id='refresh' class='btn'>
</div>
</div>
</div>
<div id="content">
</div>
</div>
<?php include("includes/smme-footer.php");?>