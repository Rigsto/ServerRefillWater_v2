<?php

include('inc/config.php');

$api = $_GET['api'];
$dispenser_id = $_GET['dis'];
$price_code = $_GET['code'];

$query = $db->query("SELECT * FROM user WHERE api='$api'");
$id = mysqli_fetch_assoc($query)['id'];
$money = mysqli_fetch_assoc($query)['money'];

$refill = $db->query("SELECT * FROM refill_price WHERE id=$price_code");
$size = mysqli_fetch_assoc($refill)['size'];
$price = mysqli_fetch_assoc($refill)['price'];

$dispenser = $db->query("SELECT remain FROM dispenser WHERE id=$dispenser_id");
$remain = mysqli_fetch_assoc($dispenser)['remain'];
$updateremain = $db->query("UPDATE dispenser SET remain=($remain-$price) WHERE id=$dispenser_id");

$timestamp = date("Y-m-d H:i:s");
$history = $db->query("INSERT INTO `history` VALUES (NULL, $id, 'refill', $dispenser_id, NULL, $size, $timestamp)");

$user = $db->query("UPDATE `user` SET money=($money-$price) WHERE id=$id");

$response = array();
if ($updateremain == 1 && $history == 1 && $user == 1) {
    $response['code'] = 1;
} else {
    $response['code'] = 0;
}

echo json_encode($response);
