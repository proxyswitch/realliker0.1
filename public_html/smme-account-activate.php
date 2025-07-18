<?php require_once("class/userprofile.class.php");
$profileobj=new profile();
$userprofile=$profileobj->profiledetails($_SESSION['smmebhaveshsitelike']);
if($userprofile['verified']==1){
header("location:smme-accept-disclaimer.php");
}
$topalert=$profileobj->sitecontent("topalert");
$admin=$profileobj->adminconfig();
include("includes/smme-header-common.php");
?>
<div class="container content">
<div class="activationpanel">
<h3 class="text-center">Verify your email to activate your account</h3>
<br><br><br><p><center>Please verify your email! if u have any issue.Please contact our support team.</p>
<br><br><br><br><br><br>
<div class="text-center"><input type="button" name="activate" value="Resend Activation Link" class="btn resend"></div>
<div class="activealert alert text-center"></div>
</div>
</div>
<?php include("includes/smme-footer.php");?>