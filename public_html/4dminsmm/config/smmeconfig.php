<?php
session_start(); //error_reporting(0);

// Allow overriding credentials with environment variables
$host = getenv('SMME_DB_HOST') ?: 'localhost';
$port = getenv('SMME_DB_PORT') ?: '';
$user = getenv('SMME_DB_USER') ?: 'smmxu_verbhaadmi';
$pass = getenv('SMME_DB_PASS') ?: '7,7{f?J_Oczf';
$db   = getenv('SMME_DB_NAME') ?: 'smmxu_version1';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$dbh  = new PDO("mysql:dbname=$db;host=$host;port=$port", $user, $pass, $options);
?>