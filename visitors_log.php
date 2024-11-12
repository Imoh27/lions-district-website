<?php

$server_data = $_SERVER;
$http_protocol  = $server_data['HTTP_HOST'] . $server_data['REQUEST_URI'] . $server_data['QUERY_STRING'];
echo $http_protocol; exit;
var_dump($server_data) ; exit;