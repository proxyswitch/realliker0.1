<?php
class perfectpanel {
    private $api_url;
    private $api_key;

    public function __construct($api_url, $api_key) {
        $this->api_url = rtrim($api_url, '/');
        $this->api_key = $api_key;
    }

    private function request(array $params) {
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        $res = curl_exec($ch);
        if ($res === false) {
            $res = json_encode(['error' => curl_error($ch)]);
        }
        curl_close($ch);
        return json_decode($res, true);
    }

    public function add(array $data) {
        return $this->request(array_merge(['key'=>$this->api_key,'action'=>'add'], $data));
    }

    public function status($order_id) {
        return $this->request(['key'=>$this->api_key,'action'=>'status','order'=>$order_id]);
    }

    public function services() {
        return $this->request(['key'=>$this->api_key,'action'=>'services']);
    }

    public function balance() {
        return $this->request(['key'=>$this->api_key,'action'=>'balance']);
    }

    public function cancel($order_id) {
        return $this->request(['key'=>$this->api_key,'action'=>'cancel','order'=>$order_id]);
    }

    public function refill($order_id) {
        return $this->request(['key'=>$this->api_key,'action'=>'refill','order'=>$order_id]);
    }
}
?>
