<?php
require_once("common.class.php");
class api_fetcher extends common {
    public function fetch($url, array $params = [], $method = 'POST') {
        $ch = curl_init();
        if ($method === 'GET' && !empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        $response = curl_exec($ch);
        if ($response === false) {
            $response = curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }

    public function fetch_json($url, array $params = [], $method = 'POST') {
        $result = $this->fetch($url, $params, $method);
        $decoded = json_decode($result, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }
        return $result;
    }
}
?>
