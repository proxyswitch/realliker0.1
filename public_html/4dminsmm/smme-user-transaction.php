<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/users-transactions.js"></script>
<div class="content container">
<h5 class="text-center title">User Payment Transaction ( Order | Wallet | Refund )</h5>
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
<label>Payment Action</label><select name="scord" class="nselect form-control" id="scord">
<option value="">Select</option>
<option value="Credit">Credit</option>
<option value="Debit">Debit</option>
</select>
</div>
<div class="text-center">
<input type='button' value='Search' id='searchbtn' class='btn'>
<input type='button' value='Refresh' id='refresh' class='btn'>
</div>
</div>
<div id="content"></div>
</div>
<?php include("includes/smme-footer.php");?>