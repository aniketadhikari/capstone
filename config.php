<?php

$server = 'ls-9fa02991449673548d9f160fa01d5cdcf436ff44.clc5keeyqtbv.us-east-1.rds.amazonaws.com';
$user = 'admin';
$pass = 'asdfghjk';

$conn = new mysqli($server, $user, $pass, 'dbmaster');

if (mysqli_connect_errno())
{
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
if (!$conn) {
    echo "Connection could not be established";
}
