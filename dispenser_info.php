<?php

include('inc/config.php');

$code = $_GET['code'];

$query = $db->query("SELECT * FROM dispenser WHERE id=$code");
$jum = mysqli_num_rows($query);
$dispenser = mysqli_fetch_assoc($query);
$response = array();

if ($jum == 1) {
    $response['code'] = 1;

    $response['place'] = $validate["place"];
    $response['floor'] = $validate['floor'];

    echo json_encode($response);
} else {
    $response['code'] = 0;
    echo json_encode($response);
}