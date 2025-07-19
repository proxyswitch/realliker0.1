<?php
// API provider configuration for order actions
if (!defined('PROVIDER_API_URL')) {
    define('PROVIDER_API_URL', getenv('PROVIDER_API_URL') ?: 'https://demo.perfectpanel.com/api/v2');
}
if (!defined('PROVIDER_API_KEY')) {
    define('PROVIDER_API_KEY', getenv('PROVIDER_API_KEY') ?: 'demo_key');
}
?>
