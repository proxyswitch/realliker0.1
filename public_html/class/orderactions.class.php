<?php
class orderactions{
    public function cancelOrder($orderId){
        // TODO: integrate provider API cancel request
        return "Cancellation requested";
    }
    public function refillOrder($orderId){
        // TODO: integrate provider API refill request
        return "Refill requested";
    }
}
?>
