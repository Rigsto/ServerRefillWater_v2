<?php

include('inc/config.php');

$api = $_GET['api'];

$query = $db->query("SELECT id FROM user WHERE api = '$api'");
$id = mysqli_fetch_assoc($query)['id'];

$history = $db->query("SELECT * FROM history WHERE user_id = $id ORDER BY time DESC");
$jum = mysqli_num_rows($history);

$response['total'] = $jum;

$response['history'] = array();
while ($row = mysqli_fetch_assoc($history)) {
    $his = array();
    $his['type'] = $row['type'];

    $size = $row['size'];
    if ($row['type'] == "refill") {
        $q = $db->query("SELECT price FROM refill_price WHERE size=$size");
        $his['balance'] = mysqli_fetch_assoc($q)['price'];
    } else {
        $his['balance'] = $row['balance'];
    }

    $his['size'] = $size;

    $dis_id = $row['dispenser_id'];
    $dispenser = $db->query("SELECT place, floor FROM dispenser WHERE id=$dis_id");
    $row2 = mysqli_fetch_assoc($dispenser);
    $his['dispenser_place'] = $row2['place'];
    $his['dispenser_floor'] = $row2['floor'];

    $his['time'] = $row['time'];

    array_push($response['history'], $his);
}

echo json_encode($response);
