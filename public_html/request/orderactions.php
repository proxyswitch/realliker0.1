<?php
require_once("../class/orderactions.class.php");
if(isset($_POST['action']) && isset($_POST['order_id'])){
    $action=$_POST['action'];
    $orderId=(int)$_POST['order_id'];
    $obj=new orderactions();
    if($action=="cancel"){
        echo $obj->cancelOrder($orderId);
    }elseif($action=="refill"){
        echo $obj->refillOrder($orderId);
    }else{
        echo "Invalid action";
    }
}
?>
