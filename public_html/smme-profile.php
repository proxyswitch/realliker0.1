<?php ob_start();include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$service=$commonobj->getservicedetailsbyname("vine");
$sitecontent=$commonobj->sitecontent("vine");
?>
<div class="container content">
<?php if(isset($_GET['msg']) && $_GET['msg']!=""){
if($_GET['msg']=="upsuccess"){ ?>
<div class="text-center margin10 msgalert">Profile has been updated.</div>	
<?php }else if($_GET['msg']=="cpsuccess"){ ?>
<div class="text-center margin10 msgalert">Password has been changed successfully.</div>	
<?php } }
if(isset($_GET['active']) && $_GET['active']=="edit"){ ?>
<div class="col-md-6 col-md-offset-3">
<div class="serviceform profileform">
<h5 class="title text-center">Profile Update</h5>
<form name="profileedit" action="" class="profileupdate" method="post">
<div class="form-group">
<label>Email</label>
<input type="text" name="email" value="<?=$userprofile['email'];?>" class="form-control" disabled>
</div>
<div class="form-group">
<label>Name</label>
<input type="text" name="name" value="<?=$userprofile['name'];?>" class="form-control required">
</div>
<div class="form-group">
<label>Skype</label>
<input type="text" name="skype" value="<?=$userprofile['skype'];?>" class="form-control required">
<input type='hidden' name='csrfToken' value='<?=$_SESSION['csrfTOken'];?>' />
</div>
<div class="text-center">
<input type="submit" name=" " value="Update" class="btn">
<input type="reset" name="Clear" value="Clear" class="btn">
<a href="smme-profile" class="btn">Back</a>
</div>
</form>

<div class="alert text-center"></div>
</div>
</div>
	
	
<?php }else if(isset($_GET['active']) && $_GET['active']=="changepassword") { ?>

<div class="col-md-6 col-md-offset-3">
<div class="serviceform passwordform">
<h5 class="title text-center">Password Change</h5>
<form name="changepassword" class="changepassword" action="" method="post">
<div class="form-group">
<label>Current Password</label>
<input type="text" name="currentpassword" value="" class="required form-control">
</div>
<div class="form-group">
<label>New Password</label>
<input type="text" name="password" value="" id="password" class="required form-control">
</div>

<div class="form-group">
<label>Confirm Password</label>
<input type="text" name="cpassword" id="cpassword" equalto="#password" value="" class="required form-control">
<input type='hidden' name='csrfToken' value='<?=$_SESSION['csrfTOken'];?>' />

</div>

<div class="text-center">
<input type="submit" name="updatepassword" value="Update Password" class="btn">
<input type="reset" name="Clear" value="Clear" class="btn">
<a href="smme-profile" class="btn">Back</a>

</div>
</form>

<div class="alert"></div>
</div>
</div>	
	
	
<?php }else { ?>
<table class="table">
<tr><th>Email</th><th>Name</th><th>Skype</th><th>Action</th></tr>
<tr><td><?=$userprofile['email'];?></td><td><?=$userprofile['name'];?></td><td><?=$userprofile['skype'];?></td><td><a href="smme-profile?active=edit">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="smme-profile?active=changepassword">Change Password</a></td></tr>
</table>
<?php } ?>

</div>
<?php include("includes/smme-footer.php");?>