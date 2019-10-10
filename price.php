<?php

include('inc/config.php');

$query = $db->query("SELECT * FROM refill_price");

$response['prices'] = array();
while ($row = mysqli_fetch_assoc($query)) {
    $dis = array();
    $ids['id'] = $row['id'];
    $dis['size'] = $row['size'];
    $dis['price'] = $row['price'];

    array_push($response['prices'], $dis);
}

echo json_encode($response);