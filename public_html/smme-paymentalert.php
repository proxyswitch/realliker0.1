<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$sitecontent=$commonobj->sitecontent("paymentalert");
?>
<div class="container content">
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