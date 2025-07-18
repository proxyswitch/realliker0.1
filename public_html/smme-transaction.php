<?php ob_start(); include("includes/smme-header.php");
include("class/commonsetting.class.php");
$commonobj=new common();
$service=$commonobj->getservicedetailsbyname("vine");
$sitecontent=$commonobj->sitecontent("vine");
?>
<script src="js/usertransactions.js"></script>
<div class="container content">
<div id="content">
</div>
</div>
<?php include("includes/smme-footer.php");?>