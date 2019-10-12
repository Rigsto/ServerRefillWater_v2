<?php

include('inc/config.php');

$api = $_GET['api'];

$query = $db->query("SELECT * FROM user WHERE api='$api'");
$x = mysqli_fetch_assoc($query);
$money = $x['money'];

$response = array();
$response['money'] = $money;

echo json_encode($response);