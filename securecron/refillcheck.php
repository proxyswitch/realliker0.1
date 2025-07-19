<?php
require_once(__DIR__ . '/config/smmeconfig.php');
require_once(__DIR__ . '/perfectpanel.class.php');
require_once(__DIR__ . '/../public_html/config/provider.php');

$api = new perfectpanel(PROVIDER_API_URL, PROVIDER_API_KEY);

// Check completed orders and refill if needed
$sql = $dbh->prepare("SELECT a.id, a.count, b.startcount, b.finishcount FROM smme_users_order a JOIN smme_users_order_urls b ON a.id=b.orderid JOIN smme_users_order_status s ON a.status=s.id WHERE s.status='Completed'");
$sql->execute();
$orders = $sql->fetchAll();
foreach ($orders as $o) {
    $required = $o['startcount'] + $o['count'];
    $current = $o['finishcount'];
    if ($current < $required) {
        $resp = $api->refill($o['id']);
        echo date('c') . " Refill for {$o['id']}: " . json_encode($resp) . "\n";
    }
}
?>
