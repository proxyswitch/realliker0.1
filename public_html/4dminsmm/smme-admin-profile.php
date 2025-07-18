<?php ob_start(); include("includes/smme-header.php");?>
<script src="js/profile.js"></script>
<div class="content container">
<h5 class="text-center title">Manage Admin Profile</h5>

<div class="commonalert text-center"></div>
<div id="content"></div>
<div class="updateprofilediv dialog" style="display:none;">
<form name="updateprofile" class="updateprofile">
<div class="form-group">
<label>UserName</label>
<input type="text" name="username" id="username" value="" class="form-control required"/>
</div>
<div class="form-group">
<label>Email</label>
<input type="text" name="email" id="email" value="" class="form-control required email" />
<input type="hidden" name="process" value="updateadmin" />
</div>
<div class="text-center">
<input type="submit" class="btn" value="Update" name="update">
</div>
</form>

</div>
<div class="changepindiv dialog" style="display:none;">
<form name="uppin" class="uppin" method="post">
<div class="form-group">
<label>Pin</label>
<input type="text" name="pin" id="pin" value="" class="form-control required"/>
<input type="hidden" name="process" value="updatepin" />
</div>
<div class="text-center">
<input type="submit" class="btn" value="Update" name="update">
</div>
</form>
</div>
<div class="updatepassworddiv dialog" style="display:none;">
<form name="updatepassword" class="updatepassword" method="post">
<div class="form-group">
<label>Current Password</label>
<input type="text" name="oldpassword" id="oldpassword" value="" class="form-control required"/>
<input type="hidden" name="process" value="updatepassword" />
</div>
<div class="form-group">
<label>New Password</label>
<input type="text" name="password" id="password" value="" class="form-control required"/>
</div>
<div class="form-group">
<label>Confirm New Password</label>
<input type="text" name="cpassword" id="cpassword" qualto="#password" value="" class="form-control required"/>
</div>
<div class="text-center">
<input type="submit" class="btn" value="Update" name="update">
</div>
</form>
<div class="alert"></div>
</div>
</div>
<?php include("includes/smme-footer.php");?>