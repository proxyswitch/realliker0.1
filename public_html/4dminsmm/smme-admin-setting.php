<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/setting.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Site Setting</h5>
<div class="commonalert text-center"></div>
<div id="content"></div>
<div class="updateprofilediv dialog" style="display:none;">
<form name="updateprofile" class="updateprofile">
<div class="form-group">
<label>Skype</label>
<input type="text" name="skype" id="skype" value="" class="form-control required"/>
</div>
<div class="form-group">
<label>From Email</label>
<input type="text" name="fromemail" id="fromemail" value="" class="form-control required email" />
<input type="hidden" name="process" value="updatesetting" />
</div>
<div class="form-group">
<label>Support Email</label>
<input type="text" name="supportemail" id="supportemail" value="" class="form-control required email" />
</div>
<div class="form-group">
<label>Paypal Email</label>
<input type="text" name="paypalemail" id="paypalemail" value="" class="form-control required email" />
</div>
<div class="form-group">
<label>Minimum Add Balance (Paypal)</label>
<input type="text" name="minimumamt" id="minimumamt" value="" class="form-control required" />
</div>

<div class="form-group">
<label>Minimum Add Balance (2Checkout)</label>
<input type="text" name="minimumamt2" id="minimumamt2" value="" class="form-control required" />
</div>
<div class="text-center">
<input type="submit" class="btn" value="Update" name="update">
</div>
</form>
</div>
</div>
<?php include("includes/smme-footer.php");?>