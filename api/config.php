<?php

$DB_HOST = 'trolley.proxy.rlwy.net:56657';   
$DB_PORT = 3306;                  
$DB_NAME = 'webproject';              
$DB_USER = 'root';
$DB_PASS = 'NEtoTHvxITFQeGQLDaBHMwDsSfFcwfFy';
$dp = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
function redirect($to){ header('Location: ' . $to); exit; }






