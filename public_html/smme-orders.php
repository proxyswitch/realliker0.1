<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$service=$commonobj->getservicedetailsbyname("vine");
$sitecontent=$commonobj->sitecontent("vine");
$orderstatus=$commonobj->orderstatuslist();
?>
<script src="js/userorders.js"></script>
<div class="container content">
<div class="row">
<div class="col-md-4 col-md-offset-4 searchbox">
<form>
<div class="form-group">
<label>Order No</label>
<input type="text" name="orderno" id="orderno" value="" class="form-control" />
</div>
<div class="form-group">
<label>Url/Username</label>
<input type="text" name="slink" id="slink" value="" class="form-control" />
</div>

<div class="form-group">
<label>Status</label>
<select name="status" class="form-control" id="status">
<option value="">Select</option>
<?php foreach($orderstatus as $ostatus){?>
<option value="<?=$ostatus['status'];?>"><?=$ostatus['status'];?></option>
<?php }?>
</select>
</div>
<div class="text-center">
<input type="button" name="search" value="Search" id="search" class="btn" />
<input type="reset" name="clear" value="Clear" class="btn" />
<input type="button" name="refresh" id="refresh" value="Refresh" class="btn" /></div>
</div>
</form>
</div>
<div class="row">
<p class="text-center">We have updated our panel please find old panel orders <a href="smme-old-orders.php">click here</a></p>
<div id="content"></div>
</div>
</div>
<?php include("includes/smme-footer.php");?>