<?php ob_start(); require_once("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$service=$commonobj->getservicedetailsbyname("Snapchat");
$sitecontent=$commonobj->sitecontent("Snapchat");
?>
<div class="container content">
<div class="col-lg-6">
<div class="serviceform">
<h4 class="text-center title">Snapchat</h4>
<div class="text-center"><input type="button" name="singleorder" value="Single Order" class="btn singleorder" /> <input type="button" name="multipleorder" value="Multiple Order" class="multipleorder btn" /></div>
<form name="serviceform" class="serviceform1" action="" method="post">
<div class="form-group">
<label>Choose Service</label>
<select name="service" id="service" class="service required form-control">
<option min="0" max="0" value="">Select </option>
<?php foreach($service as $service){ ?>
<option min="0" max="0" value="<?=$service['id'];?>"><?=$service['display'];?> </option>
<?php } ?>
</select>
</div>
<div class="singlediv">
<div class="form-group singlediv">
<label>Snapchat Url</label>
<input type="text" name="url" value="" id="url" class="required form-control" />
</div>
<div class="form-group extdatadiv" style="display:none;">
<label class="mentionlabel">Mention </label>
<input type="text" name="extdata" value="" id="extdata" class="required form-control" />
</div>
<div class="form-group">
<label>Count</label>
<input type="text" name="count" value="" id="count" class="required number count form-control" />
</div>
</div>
<div class="form-group multidiv" style="display:none;">
<label>Url|count per line</label>
<textarea name="urls" class="urls form-control required" placeholder="Format: url|count per line. ex: facebook.com/smmexchange|100"  id="urls">
</textarea>
</div>
<input type='hidden' name='csrfToken' value='<?=$_SESSION['csrfTOken'];?>' />
<input type="hidden" id="ordertype" name="ordertype" value="1" />
<input type="hidden" id="serviceprice" name="serviceprice" value="">
<input type="hidden" id="sprice" readonly="readonly" name="sprice" value="" >
<input type="hidden" id="scount" name="scount" readonly="readonly" disabled="disabled" value="" >
<input type="hidden" name="min" value="" id="min">
<input type="hidden" name="max" value="" id="max">
<div class="priceitem margin10" id="priceitem">Price Per Count: 0/0</div>
<div class="totalprice" id="totalprice">Total Price: 0/0</div>
<div class="mcount margin10" id="countre">Min Order Count: 0 Max Order Count: 0</div>
<div class="text-center margin10">
<input type="submit" name="order" value="Create Order" class="btn btn-default" />
<input type="reset" name="clear" value="Clear" class="btn-default btn" />
</div>
<div class="orderloading text-center" style="display:none;"><img src="img/ajax-load.gif" class="orderajaximage"> Processing please wait ...</div>
<div class="orderalert text-center"></div>
</form>
</div>
</div>
<div class="col-lg-6">
<div class="sitecontent">
<h4 class="text-center title">Important Note</h4>
<div class="samplecontent">
<?=$sitecontent;?>
</div>
</div>
</div>
</div>
<?php include("includes/smme-footer.php");?>