<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$sitecontent=$commonobj->sitecontent("faq");
$smmproviders=$commonobj->smmproviders();
$smmprovidercount=count($smmproviders);
?>
<div class="container content">
<div class="row content">
<?php for($i=0;$i<$smmprovidercount;$i++){ ?>
<table class="table">
<tr><th class="text-center"><?=$smmproviders[$i][1];?> Price List</th></tr>
</table>
<table class="table pricelist">
<tr><th>Service</th><th>Price/Count</th><th>Min Order</th><th>Max Order</th></tr>
<?php $commonobj->pricelist($smmproviders[$i][0]); ?>
</table> 

<?php
}?>
</div>
</div>
<?php include("includes/smme-footer.php");
?>