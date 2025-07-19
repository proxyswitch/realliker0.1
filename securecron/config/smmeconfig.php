<?php
error_reporting(1);

// Allow overriding credentials with environment variables
$host = getenv('SMME_DB_HOST') ?: 'localhost';
$port = getenv('SMME_DB_PORT') ?: '';
$user = getenv('SMME_DB_USER') ?: 'smmxu_verbha';
$pass = getenv('SMME_DB_PASS') ?: '2@h4Z@zIJ8ab';
$db   = getenv('SMME_DB_NAME') ?: 'smmxu_version1';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$dbh  = new PDO("mysql:dbname=$db;host=$host;port=$port", $user, $pass, $options);
?>