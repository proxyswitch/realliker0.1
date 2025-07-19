<?php
require_once(__DIR__ . '/../config/provider.php');
require_once(__DIR__ . '/../../securecron/perfectpanel.class.php');
class orderactions{
    private function provider(){
        return new perfectpanel(PROVIDER_API_URL, PROVIDER_API_KEY);
    }
    public function cancelOrder($orderId){
        $api = $this->provider();
        $res = $api->cancel($orderId);
        if (isset($res['status']) && $res['status'] == 'success') {
            return 'Cancellation requested';
        }
        return json_encode($res);
    }
    public function refillOrder($orderId){
        $api = $this->provider();
        $res = $api->refill($orderId);
        if (isset($res['status']) && $res['status'] == 'success') {
            return 'Refill requested';
        }
        return json_encode($res);
    }
}
?>
