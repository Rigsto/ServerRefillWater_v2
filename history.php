<?php

include('inc/config.php');
require 'carbon/autoload.php';

use Carbon\Carbon;

$api = $_GET['api'];

$query = $db->query("SELECT id FROM user WHERE api = '$api'");
$id = mysqli_fetch_assoc($query)['id'];

$history = $db->query("SELECT * FROM history WHERE user_id = $id ORDER BY time DESC");
$jum = mysqli_num_rows($history);

$response['total'] = $jum;

$response['history'] = array();
while ($row = mysqli_fetch_assoc($query)) {
    $his = array();
    $his['type'] = $row['type'];
    $his['balance'] = $row['balance'];
    $his['size'] = $row['size'];

    $dis_id = $row['dispenser_id'];
    $dispenser = $db->query("SELECT place, floor FROM dispenser WHERE id=$dis_id");
    $row2 = mysqli_fetch_assoc($dispenser);
    $his['dispenser_place'] = $row2['place'];
    $his['dispenser_floor'] = $row2['floor'];

    $his['time'] = Carbon::parse($row2['time'])->diffForHumans();

    array_push($response['history'], $his);
}

echo json_encode($response);
