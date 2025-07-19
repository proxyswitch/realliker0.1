<?php
ob_start();
include("includes/smme-header.php");
$methods = include(dirname(__DIR__)."/config/payment_methods.php");
if($_SERVER['REQUEST_METHOD']==='POST'){
    foreach($methods as $name=>$val){
        $methods[$name] = isset($_POST[$name]);
    }
    file_put_contents(dirname(__DIR__)."/config/payment_methods.php",
        "<?php\nreturn ".var_export($methods,true).";\n?>");
    header("Location: manage-payment-methods.php?updated=1");
    exit;
}
?>
<div class="container content">
<h5 class="text-center title">Manage Payment Methods</h5>
<?php if(isset($_GET['updated'])): ?>
<div class="alert alert-success text-center">Settings updated</div>
<?php endif; ?>
<form method="post">
<?php foreach($methods as $name=>$val): ?>
<div class="checkbox">
<label>
<input type="checkbox" name="<?=$name?>" <?=$val?'checked':''?>> <?=ucfirst($name)?></label>
</div>
<?php endforeach; ?>
<div class="text-center"><input type="submit" value="Save" class="btn btn-default"></div>
</form>
</div>
<?php include("includes/smme-footer.php");
?>
