<?php ob_start(); include("includes/smme-header.php");
include("class/apigen.class.php");
$obj=new apikey();
if(isset($_GET['action']) && $_GET['action']=="cproceed" && isset($_POST['securecode']) && $_POST['securecode']!=""){
$checkcount=$obj->getapidetails();
if($checkcount==0){
$obj->createapi($_POST['securecode']);
header("location:smme-api.php");	
}
}else if(isset($_GET['action']) && $_GET['action']=="regen"){
$obj->regentapi();
header("location:smme-api.php");	
} else if(isset($_GET['action']) && $_GET['action']=="secureupdate" && isset($_POST['securecode']) && $_POST['securecode']!=""){
$obj->updatesecurecode($_POST['securecode']);
header("location:smme-api.php");	
}
$apidetails=$obj->getapidetails();
?>
<div class="container content">
<?php if(isset($_GET['action']) && $_GET['action']=="create" && $apidetails==0){?> 
<div class="col-md-6 col-md-offset-3">
<div class="serviceform profileform">
<h5 class="title text-center">Api Creation</h5>
<form name="apicreate" action="smme-api.php?action=cproceed" class="apicreate" method="post">
<center><h3> Type Here Unique Secure Code </h3></center>
<div class="form-group">
<label>Secure Code</label>
<input type="text" name="securecode" value="" minlength="10" maxlength="15" class="form-control">
</div>
<div class="text-center">
<input type="submit" name=" " value="Create" class="btn">
<input type="reset" name="Clear" value="Clear" class="btn">
<a href="smme-api.php" class="btn">Back</a>
</div>
</form>
<div class="alert text-center"></div>
</div>
</div>
<?php } else if(isset($_GET['action']) && $_GET['action']=="editsecure"){?> 
<div class="col-md-6 col-md-offset-3">
<div class="serviceform profileform">
<h5 class="title text-center">Update Securecode</h5>
<form name="apiupdate" action="smme-api.php?action=secureupdate" class="apiupdate" method="post">
<div class="form-group">
<label>Secure Code</label>
<input type="text" name="securecode" value="<?=$apidetails['secrecode'];?>" minlength="10" maxlength="15" class="form-control">
</div>
<div class="text-center">
<input type="submit" name=" " value="Update" class="btn">
<input type="reset" name="Clear" value="Clear" class="btn">
<a href="smme-api.php" class="btn">Back</a>
</div>
</form>
<div class="alert text-center"></div>
</div>
</div>
<?php }
else if($apidetails==0 && !isset($_GET['action'])){?>
<center><h4>Click Below To Create Your Api</h4></center>
<div class="text-center"><a class="text-center" href="smme-api.php?action=create" style="color: white"><h2>|| Create Api ||</h2></a></div>
<?php }else if(!isset($_GET['action']) && $apidetails!=0){?>
<table class="table">
<tr><th>Securecode</th><th>Api</th><th>Status</th><th>Action</th></tr>
<tr><td><?=$apidetails['secrecode'];?>&nbsp;<a href="smme-api.php?action=editsecure">Edit</a></td><td><?=$apidetails['api'];?></td><td><?php if($apidetails['status']==0){?>Disabled<?php }else{?>Enabled<?php } ;?></td><td><a href="smme-api.php?action=regen">Re-generate Api</a></td></tr>
<center><h3> Please Contact Support Team To Enable Api Option !! </h3></center>
</table>
<?php } ?>

</div>
<?php include("includes/smme-footer.php");?>